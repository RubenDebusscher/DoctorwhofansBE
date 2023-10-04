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
			getEventsForCalendar($conn,$Start,$End,$antwoord);
			getBirthDaysForCalendar($conn,$Start,$End,$antwoord);
      getMemorialsForCalendar($conn,$Start,$End,$antwoord);
			$antwoord['ALL']=array_merge($antwoord['Events'],$antwoord['Episodes'],$antwoord['BirthDays'],$antwoord['Memorials']);
      echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);
    }
  
  }




  function getEpisodesForCalendar(&$conn,&$Start,&$End,&$resultSet){
		//add 1 hour to account for timezone offset
    $stmtEpisodes = $conn->prepare('select id,Title as title, ADDTIME(episode_Original_airdate,episode_OriginalTimeZone) as start,ADDTIME(EndTime,episode_OriginalTimeZone) as end,page_Link as raw,"time" as category,calendarId,isReadOnly,backgroundcolor from Episodes_Of_The_Day where Date(episode_Original_airdate) BETWEEN DATE(?) AND DATE(?)');
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
        $resultSet['Episodes']=[];
      } else{
        $resultSet['Episodes'] = $result->fetch_all(MYSQLI_ASSOC);
      }
    }
  
  
  }


	function getEventsForCalendar(&$conn,&$Start,&$End,&$resultSet){
    $stmtEvents = $conn->prepare('select Event_Id as id,Event_Name as title, Event_Start as start,Event_End as end, Event_Cal_Id as calendarId,Event_Body as body,Event_Category as category,if(Event_isReadOnly=1,true,false) as isReadOnly,Event_Color as color,Event_BgColor as backgroundColor from content__event where Date(Event_Start) BETWEEN DATE(?) AND DATE(?) OR Date(Event_End) BETWEEN DATE(?) AND DATE(?)');
    if(!$stmtEvents){
      die('Statement preparing failed: ' . $conn->error);
    }
    if(!$stmtEvents->bind_param("ssss",$Start,$End,$Start,$End)){
      die('Statement binding failed: ' . $conn->connect_error);
    }
    if(!$stmtEvents->execute()){
      die('Statement execution failed: ' . $stmtEvents->error);
    }else{
      $result = $stmtEvents->get_result();
      if($result->num_rows === 0){
        $resultSet['Events']=[];
      } else{
        $resultSet['Events'] = $result->fetch_all(MYSQLI_ASSOC);
      }
    }
  
  
  }





	function getBirthDaysForCalendar(&$conn,&$Start,&$End,&$resultSet){
    $stmtBirthDays = $conn->prepare("SELECT actor_Id as id,concat(actor_First_name,' ',actor_Last_name) as title,date(concat(year(?),'-',LPAD(month(actor_Birthdate),2,0),'-',LPAD(day(actor_Birthdate),2,0))) as start,date(concat(year(?),'-',LPAD(month(actor_Birthdate),2,0),'-',LPAD(day(actor_Birthdate),2,0))) as end,'false' as isReadOnly,'BirthDay' as calendarId,'allday' as category,concat(actor_Birthdate,' (',year(?)-year(actor_Birthdate),')') as location,'#FFFFFF' as color,'Every Year' as recurrenceRule  FROM api__actors where (date(concat(year(?),'-',LPAD(month(actor_Birthdate),2,0),'-',LPAD(day(actor_Birthdate),2,0))) BETWEEN DATE(?) AND DATE(?)) AND YEAR(?)>=year(actor_Birthdate)");
    if(!$stmtBirthDays){
      die('Statement preparing failed: ' . $conn->error);
    }
    if(!$stmtBirthDays->bind_param("sssssss",$Start,$Start,$Start,$Start,$Start,$End,$Start)){
      die('Statement binding failed: ' . $conn->connect_error);
    }
    if(!$stmtBirthDays->execute()){
      die('Statement execution failed: ' . $stmtBirthDays->error);
    }else{
      $result = $stmtBirthDays->get_result();
      if($result->num_rows === 0){
        $resultSet['BirthDays']=[];
      } else{
        $resultSet['BirthDays'] = $result->fetch_all(MYSQLI_ASSOC);
      }
    }
  
  
  }

	function getMemorialsForCalendar(&$conn,&$Start,&$End,&$resultSet){
    $stmtMemorials = $conn->prepare("SELECT actor_Id as id,concat(actor_First_name,' ',actor_Last_name) as title,date(concat(year(?),'-',LPAD(month(actor_Deathdate),2,0),'-',LPAD(day(actor_Deathdate),2,0))) as start,date(concat(year(?),'-',LPAD(month(actor_Deathdate),2,0),'-',LPAD(day(actor_Deathdate),2,0))) as end,'false' as isReadOnly,'Memorial' as calendarId,'allday' as category,concat(actor_Deathdate,' (',year(?)-year(actor_Deathdate),')') as location,'#FFFFFF' as color,'Every Year' as recurrenceRule  FROM api__actors where (date(concat(year(?),'-',LPAD(month(actor_Deathdate),2,0),'-',LPAD(day(actor_Deathdate),2,0))) BETWEEN DATE(?) AND DATE(?)) AND YEAR(?)>=year(actor_Deathdate)");
    if(!$stmtMemorials){
      die('Statement preparing failed: ' . $conn->error);
    }
    if(!$stmtMemorials->bind_param("sssssss",$Start,$Start,$Start,$Start,$Start,$End,$Start)){
      die('Statement binding failed: ' . $conn->connect_error);
    }
    if(!$stmtMemorials->execute()){
      die('Statement execution failed: ' . $stmtMemorials->error);
    }else{
      $result = $stmtMemorials->get_result();
      if($result->num_rows === 0){
        $resultSet['Memorials']=[];
      } else{
        $resultSet['Memorials'] = $result->fetch_all(MYSQLI_ASSOC);
      }
    }
  
  
  }












  ?>
