<?php
	// TODO: #59 fetch all strings for a given language, in order to fully localise the site
/* 
	* author: @RubenDebusscher
	* last edited on 2021-08-17


		@param $menu 						==>			get The "path" appended to the domain, to check fif that page exists
		@param $language				==> 		get the language for the content, either set by the user or by the browser
		@param $id 							==>			get the possible id for Video's or Quotes.
		@param $ip							==>			the request headers, so they can be logged.
		@param $session					==>			the php session ID
	*/
	// * set cors and make connection
	require("cors.php");
	require("connect.php");
	require("functions.php");
	// * check if connection can be made, else Die
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$antwoord = [];
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
		die("Statement binding failed: " . $conn->connect_error);
	}
	// * voer query uit, if it fails, die
	if(!$stmt->execute()){
		die("Statement execution failed: " . $stmt->error);
	}else{
		//	* get Results
		$result = $stmt->get_result();
		// ? if there is no existing page, and it is not a category, return false (Javascript will redirect this to 404)

		if ($result->num_rows === 0){
			if(stripos($menu,'Category')===false){
				$stmt->close();
				$page = 1603;
				getContent($conn,$page,$language,$antwoord);
				getEpisodeOfTheDay($conn,$antwoord);
			getActorsOfTheDay($conn,$antwoord);

			}else{
				$stmt->close();
				$contents = explode(':', $menu);
				$RawCategory = end($contents);
				getPagesForTag($conn,0,$RawCategory,$antwoord);
				getEpisodeOfTheDay($conn,$antwoord);
				getActorsOfTheDay($conn,$antwoord);
				//echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);
			}
		}else{
			$antwoord['Page'] = $result->fetch_all(MYSQLI_ASSOC);
			processPageData($antwoord,$current_Page_Id,$prefix,$Page_Name);
			$stmt->close();
			$API_Item = $antwoord['Page'][0]['page_API_Item'];
			getRichContent($conn,$prefix,$API_Item,$antwoord);
			getSubPages($conn,$current_Page_Id,$antwoord);
			getPath($conn,$current_Page_Id,$antwoord);
			getEpisodeOfTheDay($conn,$antwoord);
			getActorsOfTheDay($conn,$antwoord);
			getPagesForTag($conn,$API_Item,"",$antwoord);
			getContent($conn,$current_Page_Id,$language,$antwoord);
			getTags($conn,$current_Page_Id,$antwoord);
			getDownloads($conn,$current_Page_Id,$antwoord);
		}

		echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);
		$conn->close();
	}


?>