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
	$image_list=[];
	require("cors.php");
	require("connect.php");

  $antwoord['AantalPagesPerAantalElements'] = "Geen resultaten gevonden."; //geef mee wat er in het object zit
	mysqli_set_charset($conn,'utf8'); //stel the charset in
	/* prepare de query (maak de query zonder de variabelen op te nemen)*/
	$stmt1 = $conn->prepare("SELECT group_concat(IF(Languages is not null, concat(page_Name,' (',Languages,')'), page_Name))as pages,count(page_Name)as Aantal_Pag,aantal as Aantal_elem FROM `Page_Count_Items` group by aantal;");
    
	if(!$stmt1){    //als het preparen mislukt --> die
        die("Statement preparing failed: " . $conn->error);
	}
	if(!$stmt1->execute()){    //voer de query uit
	    die("Statement execution failed: " . $stmt1->error);
	}
    else{
	    $result = $stmt1->get_result();	    //return de json data
	    if($result->num_rows === 0) exit('No rows');
        $antwoord['AantalPagesPerAantalElements'] = $result->fetch_all(MYSQLI_ASSOC);
        
	}
    $stmt1->close();    //sluit de query en de connectie af












    $stmt2 = $conn->prepare("SELECT Page_Name from management__pages left join content__items on management__pages.page_Id=content__items.item_Page where item_Page is null;");
    
	if(!$stmt2){    //als het preparen mislukt --> die
        die("Statement preparing failed: " . $conn->error);
	}
	if(!$stmt2->execute()){    //voer de query uit
	    die("Statement execution failed: " . $stmt2->error);
	}
    else{
	    $result = $stmt2->get_result();	    //return de json data
	    if($result->num_rows === 0){
			$antwoord['EmptyPages']='No rows';
		} else{
			$antwoord['EmptyPages'] = $result->fetch_all(MYSQLI_ASSOC);
		}
	}
    $stmt2->close(); 
    
    
    
    
    $stmt3 = $conn->prepare("SELECT page_Name, page_Link, COUNT(content__items.item_Id)as aantal, GROUP_CONCAT( DISTINCT management__languages.language_Name ) as Languages FROM management__pages LEFT JOIN content__items ON management__pages.page_Id = content__items.item_Page LEFT JOIN content__items_languages ON content__items_languages.IL_item_Id = content__items.item_Id LEFT JOIN management__languages ON management__languages.language_Id = content__items_languages.IL_language_Id GROUP BY page_Id;");


    
	if(!$stmt3){    //als het preparen mislukt --> die
        die("Statement preparing failed: " . $conn->error);
	}
	if(!$stmt3->execute()){    //voer de query uit
	    die("Statement execution failed: " . $stmt3->error);
	}
    else{
	    $result = $stmt3->get_result();	    //return de json data
	    if($result->num_rows === 0) {$antwoord['LangPages']='No rows';}else{
				$antwoord['LangPages'] = $result->fetch_all(MYSQLI_ASSOC);
			}
       
	}
    $stmt3->close();
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
		$stmt4 = $conn->prepare("SELECT page_Name, group_concat(management__categories.category_Name) as Tags FROM `management__pages` left join management__pages_categories on management__pages.page_Id=management__pages_categories.PC_page_Id left join management__categories on management__pages_categories.PC_category_Id=management__categories.category_Id group by page_Id;");
    
		if(!$stmt4){    //als het preparen mislukt --> die
					die("Statement preparing failed: " . $conn->error);
		}
		if(!$stmt4->execute()){    //voer de query uit
				die("Statement execution failed: " . $stmt4->error);
		}
			else{
				$result = $stmt4->get_result();	    //return de json data
				if($result->num_rows === 0) {$antwoord['Tags']='No rows';}else{
					$antwoord['Tags'] = $result->fetch_all(MYSQLI_ASSOC);
			}

		}
			$stmt4->close();    //sluit de query en de connectie a  
    
    
    
    
   
    
    $stmt5 = $conn->prepare("SELECT Replace(Replace(management__pages.page_Link,')',''),'(','') as A_Pagina, item_Value as A_Waarde from content__items inner join management__pages on management__pages.page_Id=content__items.item_Page where item_Value like '%<a href%' and item_Active=1;");
	if(!$stmt5){
	    	    die("Statement preparing failed: " . $conn->error);

	}
	$menu =$_GET['menu'];
	
	if(!$stmt5->execute()){
	    die("Statement execution failed: " . $stmt5->error);
	}else{
	    //return de json data
	    $result = $stmt5->get_result();
	    if($result->num_rows === 0) {$antwoord['LinksInContent']='No rows';}else{

				while ($row=mysqli_fetch_array($result))
{
    $text = $row['A_Waarde'];
    preg_match_all('/(\b(https?|ftp|file|http):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/is', $text, $matches);
    $img_list=array_merge($image_list,$matches[0]);  // append to array       
}
       $antwoord['LinksInContent'] = $img_list;
			}
   
	}
    
    
    $stmt5->close();
    
    
		$stmt6 = $conn->prepare("SELECT * from management__pages");
		if(!$stmt6){
							die("Statement preparing failed: " . $conn->error);
	
		}
		
		if(!$stmt6->execute()){
				die("Statement execution failed: " . $stmt6->error);
		}else{
				//return de json data
				$result = $stmt6->get_result();
				if($result->num_rows === 0) {$antwoord['AllLinks']='No rows';}else{
				//	$antwoord['AllLinks'] = $result->fetch_all(MYSQLI_ASSOC);
				}
		 
		}
			
			
			$stmt6->close();
    
    
    
    
    
    
    
    
    
    
    
    
    //sluit de query en de connectie af
    $conn->close();
    echo json_encode($antwoord, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT | JSON_UNESCAPED_LINE_TERMINATORS );
?>



