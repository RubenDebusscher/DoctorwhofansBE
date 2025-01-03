<?php
  require("cors.php");
  require("connect.php");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $antwoord = [];
  $antwoord['data'] = "Geen resultaten gevonden.";
  mysqli_set_charset($conn,'utf8');
  $stmt1 = $conn->prepare("select language_Name,language_LongName from management__languages order by language_LongName");
  if(!$stmt1){
      die("Statement preparing failed: " . $conn->error);
  }
  
  
  if(!$stmt1->execute()){
      die("Statement execution failed: " . $stmt1->error);
  }else{
      //return de json data
      $result = $stmt1->get_result();
      if($result->num_rows === 0) exit('No rows');
        $antwoord['data'] = $result->fetch_all(MYSQLI_ASSOC);
  }
  $stmt1->close();
  $conn->close();
  echo json_encode($antwoord, JSON_PRETTY_PRINT);

?>