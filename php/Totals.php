<?php
  	



    $type = $_POST['TOTAL'];
    switch($type){
      case "TotalPerSeason":
        TotalPerSeason();
        break;
      case "TotalPerShow":
        TotalPerShow();
        break;
      case "TotalPerSeasonAndState":
      TotalPerSeasonAndState();
        break;




    }



function TotalPerSeasonAndState(){
  require("cors.php");
  require("connect.php");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
 $antwoord = [];
  $antwoord['data'] = "Geen resultaten gevonden.";
  mysqli_set_charset($conn,'utf8');
  $stmt1 = $conn->prepare("SELECT CONCAT(api__shows.show_name,': ', api__seasons.season_Name,': ', api__reconstructions.reconstruction_Name) AS titel, SUM(episode_Runtime_in_seconds) AS total FROM api__episodes` INNER JOIN api__serials ON api__episodes.episode_Serial_Id = api__serials.serial_Id INNER JOIN api__seasons ON api__seasons.season_Id = api__serials.season_id INNER JOIN api__shows ON api__seasons.season_Show_Id = api__shows.show_id inner join api__episodes_reconstructions on api__episodes_reconstructions.ER_Episode_Id = api__episodes.episode_Id inner join api__reconstructions on api__reconstructions.reconstruction_Id =api__episodes_reconstructions.ER_Reconstruction_Id GROUP BY api__shows.show_id,api__seasons.season_Id,api__episodes_reconstructions.ER_Reconstruction_Id;");
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
        echo json_encode($antwoord, JSON_PRETTY_PRINT);
  }
    $stmt1->close();
    $conn->close();


}

function TotalPerShow(){
  require("cors.php");
    require("connect.php");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
 $antwoord = [];
  $antwoord['data'] = "Geen resultaten gevonden.";
  mysqli_set_charset($conn,'utf8');
  $stmt1 = $conn->prepare("SELECT CONCAT(api__shows.show_name,': alle afleveringen ') AS titel,SUM(episode_Runtime_in_seconds) AS total FROM `api__episodes` INNER JOIN api__serials ON api__episodes.episode_Serial_Id = api__serials.serial_Id INNER JOIN api__seasons ON api__seasons.season_Id = api__serials.season_id INNER JOIN api__shows ON api__seasons.season_Show_Id = api__shows.show_id GROUP BY api__shows.show_id");
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
        echo json_encode($antwoord, JSON_PRETTY_PRINT);
  }
    $stmt1->close();
    $conn->close();





}



function TotalPerShowAndState(){
  require("cors.php");
    require("connect.php");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
 $antwoord = [];
  $antwoord['data'] = "Geen resultaten gevonden.";
  mysqli_set_charset($conn,'utf8');
  $stmt1 = $conn->prepare("SELECT CONCAT(api__shows.show_name,': ',api__reconstructions.reconstruction_Name) AS titel, SUM(episode_Runtime_in_seconds) AS total FROM   `api__episodes` INNER JOIN api__serials ON api__episodes.episode_Serial_Id = api__serials.serial_Id INNER JOIN api__seasons ON api__seasons.season_Id = api__serials.season_id INNER JOIN api__shows ON api__seasons.season_Show_Id = api__shows.show_id inner join api__episodes_reconstructions on api__episodes_reconstructions.ER_Episode_Id = api__episodes.episode_Id inner join api__reconstructions on api__reconstructions.reconstruction_Id =api__episodes_reconstructions.ER_Reconstruction_Id GROUP BY api__shows.show_id,api__episodes_reconstructions.ER_Reconstruction_Id;");
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
        echo json_encode($antwoord, JSON_PRETTY_PRINT);
  }
    $stmt1->close();
    $conn->close();





}



function TotalPerSeason(){
  require("cors.php");
  require("connect.php");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
     $antwoord = [];
    $antwoord['data'] = "Geen resultaten gevonden.";
    mysqli_set_charset($conn,'utf8');
    $stmt1 = $conn->prepare("SELECT CONCAT(api__shows.show_name,': ',api__seasons.season_Name) AS titel,SUM(episode_Runtime_in_seconds) AS total FROM `api__episodes` INNER JOIN api__serials ON api__episodes.episode_Serial_Id = api__serials.serial_Id INNER JOIN api__seasons ON api__seasons.season_Id = api__serials.season_id INNER JOIN api__shows ON api__seasons.season_Show_Id = api__shows.show_id GROUP BY api__shows.show_id,api__seasons.season_Id");
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
          echo json_encode($antwoord, JSON_PRETTY_PRINT);
    }
      $stmt1->close();
      $conn->close();
      //this is a test







}






?>