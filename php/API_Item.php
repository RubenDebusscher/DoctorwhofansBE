
<?php
  require("connect.php");         // open connection
  
  if ($conn->connect_error) {     // check if there is a connection error
      die("Connection failed: " . $conn->connect_error);
  }
  
  $antwoord = []; // create the response object
  $antwoord['data'] = "Geen resultaten gevonden."; // default message
  
  mysqli_set_charset($conn, 'utf8');
  
  // Get item ID from URL parameter and validate
  $itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;
  
  if ($itemId <= 0) {
      die("Invalid ID");
  }
  
  // Prepare the SQL query
  $stmt1 = $conn->prepare("
      SELECT V3__ItemAttributes.*,V3__Attributes.Name as Attribute,V3__Validationrules.Name as Rule FROM `V3__ItemAttributes` inner join V3__Attributes on V3__ItemAttributes.AttributeID=V3__Attributes.AttributeID inner join V3__Validationrules on V3__Validationrules.ValidationRuleID=V3__Attributes.ValidationRuleID 
      WHERE ItemID = ?
  ");
  
  if (!$stmt1) {
      die("Statement preparing failed: " . $conn->error);
  }
  
  $stmt1->bind_param("i", $itemId); // bind parameter
  
  if (!$stmt1->execute()) {
      die("Statement execution failed: " . $stmt1->error);
  } else {
      $result = $stmt1->get_result(); // get result
  
      if ($result->num_rows === 0) {
        $antwoord['data']=[];
      }
  
      $antwoord['data'] = $result->fetch_all(MYSQLI_ASSOC); // fetch as associative array
      echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);  // output as JSON
  }
  
  $stmt1->close(); // close the statement
  $conn->close();  // close the connection
  
?>