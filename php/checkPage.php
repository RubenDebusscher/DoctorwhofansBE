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
			//		? Check if the URL exists, with said language, and log IP (so errors can be backtraced)
			// 		* Prepare the query, die if it fails
			$stmt = $conn->prepare("call checkPage(?,?,?)");
			if(!$stmt){
				die("Statement prepare failed: " . $conn->connect_error);
			}
			$menu=$_POST['menu'];
			$language = $_POST['lang'];
			$id=$_POST['Itemid'];
			$ip=json_encode(apache_request_headers());
			$session=$_COOKIE['PHPSESSID'];
			//	* bind parameters to query, if it fails, die
			if(!$stmt->bind_param("sss",$menu,$ip,$session)){
				die("Statement binding failed: " . $stmt->error);
				//$conn->close();
			}
			// * voer query uit, if it fails, die
			if(!$stmt->execute()){
				die("Statement execution failed: " . $stmt->error);
				//$conn->close();
			}else{
				//	* get Results
				$result = $stmt->get_result();
				// ? if there is no existing page, and it is not a category, return false (Javascript will redirect this to 404)

				if ($result->num_rows === 0){
					$antwoord['Err']=$menu;
					if(stripos($menu,'Category')===false){
						$stmt->close();
						$page = 1603;
						getTranslations($conn,$language,$antwoord);
						getContent($conn,$page,$language,$antwoord);
						getPath($conn,$page,$antwoord);
						getEpisodeOfTheDay($conn,$antwoord);
						getActorsOfTheDay($conn,$antwoord);
					//$conn->close();

					}else{
						$stmt->close();
						$menu=$_POST['menu'];
						$contents = explode(':', $menu);
						$RawCategory = end($contents);
						getTranslations($conn,$language,$antwoord);
						getPagesForTag($conn,0,$menu,$antwoord);
						getEpisodeOfTheDay($conn,$antwoord);
						getActorsOfTheDay($conn,$antwoord);
						
						//echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);
					}
				}else{
					$antwoord['Page'] = $result->fetch_all(MYSQLI_ASSOC);
					
					processPageData($antwoord,$current_Page_Id,$prefix,$Page_Name);
					$stmt->close();
					$API_Item = $antwoord['Page'][0]['page_API_Item'];
					getTranslations($conn,$language,$antwoord);
					getRichContent($conn,$prefix,$API_Item,$antwoord);
					getSubPages($conn,$current_Page_Id,$antwoord);
					getPath($conn,$current_Page_Id,$antwoord);
					getEpisodeOfTheDay($conn,$antwoord);
					getActorsOfTheDay($conn,$antwoord);
					getPagesForTag($conn,$API_Item,"",$antwoord);
					getContent($conn,$current_Page_Id,$language,$antwoord);
					getTags($conn,$current_Page_Id,$antwoord);
					getDownloads($conn,$current_Page_Id,$antwoord);
					getGalleries($conn,$current_Page_Id,$antwoord);
				}
				
				echo json_encode($antwoord,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
				$conn->close();
			}

		}

	}
	
	


?>