<?php
  	require("cors.php");
    require("connect.php");
    /* if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    mysqli_set_charset($conn,'utf8');
    $stmt1 = $conn->prepare('insert into fcm__tokens (id,token) values (null,?)');
    if(!$stmt1){
      die('Statement preparing failed: ' . $conn->error);
    }
    $token = ;
    if(!$stmt1->bind_param('s',$token)){
      die('Statement binding failed: ' . $conn->connect_error);
    }
    if(!$stmt1->execute()){
      die('Statement execution failed: ' . $stmt1->error);
    } */
    echo $$_REQUEST['body'];
    
    
      //$stmt1->close();
     // $conn->close();
?>