<?php
	// TODO: #59 fetch all strings for a given language, in order to fully localise the site
/* 
	* author: @RubenDebusscher
	* last edited on 2022-15-15


		@param $menu 						==>			get The "path" appended to the domain, to check fif that page exists
		@param $language				==> 		get the language for the content, either set by the user or by the browser
		@param $id 							==>			get the possible id for Video's or Quotes.
		@param $ip							==>			the request headers, so they can be logged.
		@param $session					==>			the php session ID
	*/
	// * set cors and make connection
	error_reporting(E_ALL ^ E_WARNING);
	$antwoord = [];
	require("cors.php");
	require("connect.php");
  require("functions.php");

	// * check if connection can be made, else Die
	
	$stmtConn = $conn->prepare("show status where `variable_name` = 'Threads_connected';");
	if(!$stmtConn){
		die("Statement prepare failed: " . $conn->connect_error);
	}
	if(!$stmtConn->execute()){
		die("Statement execution failed: " . $stmtConn->error);
		//$conn->close();
	}else{
		$result = $stmtConn->get_result();
		$resultSet = $result->fetch_all(MYSQLI_ASSOC);
		$toCheck= json_encode($resultSet[0]["Value"]);
		$stmtConn->close();
		if($toCheck >35){
			$conn->close();
		}else{
			mysqli_set_charset($conn,'utf8');
      
      $Start= $_POST['Start'];
      $End= $_POST['End'];
      getEpisodesForCalendar($conn,$Start,$End,$antwoord);
      echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);
    }
  
  }




  function getEpisodesForCalendar(&$conn,&$Start,&$End,&$resultSet){
    $stmtEpisodes = $conn->prepare('select id,Title as title, episode_Original_airdate as start,EndTime as end,page_Link as body,"time" as category,calendarId,isReadOnly,backgroundcolor from Episodes_Of_The_Day where Date(episode_Original_airdate) BETWEEN DATE(?) AND DATE(?)');
    if(!$stmtEpisodes){
      die('Statement preparing failed: ' . $conn->error);
    }
    if(!$stmtEpisodes->bind_param("ss",$Start,$End)){
      die('Statement binding failed: ' . $conn->connect_error);
    }
    if(!$stmtEpisodes->execute()){
      die('Statement execution failed: ' . $stmtEpisodes->error);
    }else{
      $result = $stmtEpisodes->get_result();
      if($result->num_rows === 0){
        $resultSet['Episodes']='No rows';
      } else{
        $resultSet['Episodes'] = $result->fetch_all(MYSQLI_ASSOC);
      }
    }
  
  
  }

















  ?>
