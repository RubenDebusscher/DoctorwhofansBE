<?php
header('Content-Type: application/json');
require("connect.php"); // your DB connection, conn instance in $conn

$itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($itemId <= 0) {
    echo json_encode(['error' => 'Invalid ItemID']);
    exit;
}

// Step 1: Get ContentType of the item
$stmt = $conn->prepare("SELECT Type FROM V3__Items WHERE ItemID = ?");
$stmt->bind_param("i", $itemId);
$stmt->execute();
$stmt->bind_result($contentType);
if (!$stmt->fetch()) {
    echo json_encode(['error' => 'Item not found']);
    exit;
}
$stmt->close();

// Step 2: Get allowed attributes for this content type
$sql = "
  SELECT a.AttributeID, a.Name as Attribute, r.Name as ValidationRuleType, a.ValidationRuleID,a.LookupTable,a.BaseAttributes,a.Template,a.Repeatable
  FROM V3__AttributeContentTypes ca
  JOIN V3__Attributes a ON ca.AttributeID = a.AttributeID
  JOIN V3__Validationrules r ON a.ValidationRuleID = r.ValidationRuleID
  WHERE ca.ContentTypeID = ? order by ca.OrderIndex asc;
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $contentType);
$stmt->execute();
$result = $stmt->get_result();
$allowedAttributes = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Step 3: Get attributes already filled for this item
$stmt = $conn->prepare("SELECT AttributeID FROM V3__ItemAttributes WHERE ItemID = ?");
$stmt->bind_param("i", $itemId);
$stmt->execute();
$result = $stmt->get_result();
$filledAttributes = [];
while ($row = $result->fetch_assoc()) {
    $filledAttributes[] = $row['AttributeID'];
}
$stmt->close();

// Step 4: Filter out filled attributes
$missingAttributes = array_filter($allowedAttributes, function ($attr) use ($filledAttributes) {
    // Keep the attribute if it's not filled OR if it's repeatable
    return !in_array($attr['AttributeID'], $filledAttributes) || intval($attr['Repeatable']) === 1;
});

// Step 5: For lookup types, fetch options
foreach ($missingAttributes as &$attr) {
  
  if (in_array($attr['ValidationRuleType'], ['lookup', 'LookupTable'])) {
    if (!in_array($attr['ValidationRuleType'], ['lookup', 'LookupTable'])) {
      $attr['Options'] = [];
      $attr['LookupError'] = 'No LookupTable defined';
      continue;
  }

      // Sanitize table name (allow only alphanumerics and underscores)
      $table = preg_replace('/[^a-zA-Z0-9_]/', '', $attr['LookupTable']);

      // Make sure it is not empty
      if (!$table) {
          $attr['Options'] = [];
          continue;
      }

      // Compose query manually (since table names can't be bound)
      $sql = "SELECT ItemID as value, Name as label FROM `$table`";
      $result = $conn->query($sql);

      if (!$result) {
          $attr['Options'] = [];
          echo "MySQL Error: " . $conn->error . "\n";
      } else {
          $attr['Options'] = $result->fetch_all(MYSQLI_ASSOC);
      }


     
  }
}


echo json_encode(['data' => array_values($missingAttributes)]);



?>