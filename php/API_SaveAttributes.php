<?php
session_start();
header('Content-Type: application/json');

require("connect.php"); // your DB connection, conn instance in $conn
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current user ID
$currentUsername = $_SESSION['user'] ?? null;
$userId = 0;

if ($currentUsername) {
    $stmt = $conn->prepare("SELECT user_Id as id FROM management__users WHERE user_Name = ?");
    $stmt->bind_param("s", $currentUsername);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();
}

if (!$userId) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated.']);
    exit;
}

$itemId = intval($_POST['ItemID'] ?? 0);
$attributes = $_POST['attr'] ?? [];

if (!$itemId || !is_array($attributes)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    exit;
}

$errors = [];

foreach ($attributes as $attrId => $value) {
    $attrId = intval($attrId);
    $value = trim($value);
    if ($value === '') continue;

    // Get validation rule
    $stmt = $conn->prepare("
        SELECT v.Name 
        FROM V3__Attributes a
        JOIN V3__Validationrules v ON a.ValidationRuleID = v.ValidationRuleID
        WHERE a.AttributeID = ?
    ");
    $stmt->bind_param("i", $attrId);
    $stmt->execute();
    $stmt->bind_result($rule);
    $stmt->fetch();
    $stmt->close();

    if (!$rule) {
        $errors[] = "No validation rule for AttributeID $attrId";
        continue;
    }

    // Prepare values based on rule
    $text = $num = $date = $bool = $lookup = null;

    switch (strtolower($rule)) {
        case 'text':
            $text = $value;
            break;
        case 'number':
            if (!is_numeric($value)) {
                $errors[] = "Attribute $attrId requires numeric value.";
                continue 2;
            }
            $num = floatval($value);
            break;
        case 'datetime':
            $date = date('Y-m-d H:i:s', strtotime($value));
            if (!$date) {
                $errors[] = "Invalid datetime for Attribute $attrId.";
                continue 2;
            }
            break;
        case 'boolean':
            if ($value !== '0' && $value !== '1') {
                $errors[] = "Boolean attribute $attrId must be 0 or 1.";
                continue 2;
            }
            $bool = intval($value);
            break;
        case 'lookuptable':
        case 'lookup':
            if (!ctype_digit($value)) {
                $errors[] = "Lookup attribute $attrId requires integer value.";
                continue 2;
            }
            $lookup = intval($value);
            break;
        default:
            $text = $value; // fallback as text
    }

    // Check if exact record exists (ItemID, AttributeID, same value)
    $checkSql = "SELECT ItemAttributeValueID FROM V3__ItemAttributes WHERE ItemID = ? AND AttributeID = ? AND 
        ((? IS NOT NULL AND Value = ?) OR
         (? IS NOT NULL AND NumberValue = ?) OR
         (? IS NOT NULL AND DateValue = ?) OR
         (? IS NOT NULL AND BoolValue = ?) OR
         (? IS NOT NULL AND LookupValue = ?)) LIMIT 1";

    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param(
      "iisssisssiii",
      $itemId,
      $attrId,
      $text, $text,
      $num, $num,
      $date, $date,
      $bool, $bool,
      $lookup, $lookup
  );
    $stmt->execute();
    $stmt->bind_result($existingId);
    $exists = $stmt->fetch();
    $stmt->close();

    if ($exists) {
        // Record exists with same value, update updated_at and updated_by only
        $updateSql = "UPDATE V3__ItemAttributes SET updated_at = NOW(), updated_by = ? WHERE ItemAttributeValueID = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ii", $userId, $existingId);
        $stmt->execute();
        $stmt->close();
        continue;
    }

    // Insert new record (different value or no record found)
    $insertSql = "INSERT INTO V3__ItemAttributes (
                    ItemID, AttributeID, Value, NumberValue, DateValue, BoolValue, LookupValue,
                    created_at, updated_at, created_by, updated_by
                  ) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?)";

    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param(
        "iissdiiii",
        $itemId,
        $attrId,
        $text,
        $num,
        $date,
        $bool,
        $lookup,
        $userId,
        $userId
    );
    if (!$stmt->execute()) {
        $errors[] = "Failed to save attribute $attrId: " . $stmt->error;
    }
    $stmt->close();
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => implode('; ', $errors)]);
} else {
    echo json_encode(['success' => true]);
}
?>
