<?php
	$antwoord = [];
function processPageData(&$resultset,&$current_Page_Id,&$prefix,&$Page_Name){
	$current_Page=$resultset['Page'][0]['page_Link'];
	$current_Page_Id =$resultset['Page'][0]['page_Id'];
	$prefix = $resultset['Page'][0]['pagetype_Name'];
	$Page_Name = substr(strrchr($current_Page, "/"), 1);
}

function getRichContent(&$conn,&$prefix,&$API_Item,&$antwoord){
	switch ($prefix) {
		case "Sitemap":
			buildSiteMap($conn,$antwoord);
			break;
		case "Episode":
			getEpisodeData($conn,$API_Item,$antwoord);
			break;
		case "Doctor":
			getDoctor($conn,$API_Item,$antwoord);
			getFirstAndLastEpisodeForCharacter($conn,$API_Item,$antwoord);
			getCharacter($conn,$API_Item,$antwoord);
			getRegenerationForCharacter($conn,$API_Item,$antwoord);
			break;
		case "Character":
			getCharacter($conn,$API_Item,$antwoord);
			getFirstAndLastEpisodeForCharacter($conn,$API_Item,$antwoord);
			getRegenerationForCharacter($conn,$API_Item,$antwoord);
			break;
		case "Book":
			echo "Zoek de data van een Book: ".$prefix;
			break;
		case "Crew":
			echo "Zoek de data van een Crewlid: ".$prefix;
			break;
		case "Quotes":
			getQuotes($conn,$id,$antwoord);
			break;
		case "Video":
			getVideos($conn,$id,$antwoord);
			break;


	}
}
function getCharacter(&$conn,&$API_Item,&$resultset){
	$stmtCharacter = $conn->prepare("select * from api__characters where character_Id=?");
					if(!$stmtCharacter){
						die("Statement prepare failed: " . $conn->connect_error);
					}
					if(!$stmtCharacter->bind_param("i",$API_Item)){
						die("Statement binding failed: " . $conn->connect_error);
					}
					if(!$stmtCharacter->execute()){
						die("Statement execution failed: " . $stmtCharacter->error);
					}else{
						//return de json data
						$result = $stmtCharacter->get_result();
						if($result->num_rows === 0){
							$resultset['Character']=" Character not found";
						}else{
							$resultset['Character'] = $result->fetch_all(MYSQLI_ASSOC);
							$stmtCharacter->close();
						}
					}
					$stmtActorsForCharacter = $conn->prepare('select *,api__characters_actors.AC_Type from Actors_With_Link left join api__characters_actors on actor_Id = AC_Actor_Id where AC_Character_Id=?');
					if(!$stmtActorsForCharacter){
						die('Statement preparing failed: ' . $conn->error);
					}
					if(!$stmtActorsForCharacter->bind_param("i",$API_Item)){
						die('Statement binding failed: ' . $conn->connect_error);
					}
					if(!$stmtActorsForCharacter->execute()){
						die('Statement execution failed: ' . $stmtActorsForCharacter->error);
					}else{
						$result = $stmtActorsForCharacter->get_result();
						if($result->num_rows === 0){
							$resultset['Character'][0]['ActorList']='No rows';
						} else{
							$resultset['Character'][0]['ActorList']= $result->fetch_all(MYSQLI_ASSOC);
						}
					}
}

function getDoctor(&$conn,&$API_Item,&$resultset){
	$stmtDoctor = $conn->prepare("select * from Characters_With_Actor where character_Id=?");
	if(!$stmtDoctor){
		die("Statement prepare failed: " . $conn->connect_error);
	}
	if(!$stmtDoctor->bind_param("i",$API_Item)){
		die("Statement binding failed: " . $conn->connect_error);
	}
	if(!$stmtDoctor->execute()){
		die("Statement execution failed: " . $stmtDoctor->error);
	}else{
		//return de json data
		$result = $stmtDoctor->get_result();
		if($result->num_rows === 0){
			$resultset['Doctor']="No Doctor found";
		}else{
			$resultset['Doctor'] = $result->fetch_all(MYSQLI_ASSOC);
			$stmtDoctor->close();
		}
	}
	// TODO: #60 Fetch list of all actors who played this role, same for other characters
	$stmtActorsForDoctor = $conn->prepare('select *,api__characters_actors.AC_Type from Actors_With_Link left join api__characters_actors on actor_Id = AC_Actor_Id where AC_Character_Id=?');
	if(!$stmtActorsForDoctor){
		die('Statement preparing failed: ' . $conn->error);
	}
	if(!$stmtActorsForDoctor->bind_param("i",$API_Item)){
		die('Statement binding failed: ' . $conn->connect_error);
	}
	if(!$stmtActorsForDoctor->execute()){
		die('Statement execution failed: ' . $stmtActorsForDoctor->error);
	}else{
		$result = $stmtActorsForDoctor->get_result();
		if($result && ($result->num_rows === 0)){
			$resultset['Doctor'][0]['ActorList']='No rows';
		} else{
			$resultset['Doctor'][0]['ActorList'] = array();
			$resultset['Doctor'][0]['ActorList']= $result->fetch_all(MYSQLI_ASSOC);
		}
	}

}

function getFirstAndLastEpisodeForCharacter(&$conn, &$API_Item, &$resultset)
{
    $stmtFALEpisode = $conn->prepare("call GetFirstAndLastRegularEpisode(?)");
    if (!$stmtFALEpisode) {
        die("Statement prepare failed: " . $conn->connect_error);
    }
    if (!$stmtFALEpisode->bind_param("i", $API_Item)) {
        die("Statement binding failed: " . $conn->connect_error);
    }
    if (!$stmtFALEpisode->execute()) {
        die("Statement execution failed: " . $stmtFALEpisode->error);
    } else {
        //return de json data
        $result = $stmtFALEpisode->get_result();
        if ($result->num_rows === 0) {
            $resultset['FALEpisode']="No Episodes found";
        } else {
            $resultset['FALEpisode'] = $result->fetch_all(MYSQLI_ASSOC);
            $stmtFALEpisode->close();
        }
    }
}

//TODO #65 add backend code to fetch nicknames

function getRegenerationForCharacter(&$conn, &$API_Item, &$resultset)
{
    $stmtREGENpisode = $conn->prepare("call GetRegenerationEpisode(?)");
    if (!$stmtREGENpisode) {
        die("Statement prepare failed: " . $conn->connect_error);
    }
    if (!$stmtREGENpisode->bind_param("i", $API_Item)) {
        die("Statement binding failed: " . $conn->connect_error);
    }
    if (!$stmtREGENpisode->execute()) {
        die("Statement execution failed: " . $stmtREGENpisode->error);
    } else {
        //return de json data
        $result = $stmtREGENpisode->get_result();
        if ($result->num_rows === 0) {
            $resultset['REGENepisode']="No Regeneration Episode found";
        } else {
            $resultset['REGENepisode'] = $result->fetch_all(MYSQLI_ASSOC);
            $stmtREGENpisode->close();
        }
    }
}

	function getQuotes(&$conn,&$id,&$resultset){
		$QuoteIdFromURL =$_POST['Itemid'];
					if($QuoteIdFromURL==0){
						$MaxLimit = $conn->prepare('select max(quote_Id) as max from Quotes');
						if(!$MaxLimit){
							die('Statement preparing failed: ' . $conn->error);
						}
						if(!$MaxLimit->execute()){
							die('Statement execution failed: ' . $MaxLimit->error);
						}else{
							$resultMaxQuoteId = $MaxLimit->get_result();
							if($resultMaxQuoteId->num_rows === 0){
								$antwoord['MaxQuoteId']='No rows';
							} else{
								$MaxQuoteId = $resultMaxQuoteId->fetch_all(MYSQLI_ASSOC);
							}
						}
						$QuoteIdFromURL=rand(1,$MaxQuoteId[0]['max']);
					}
					$stmtMainQuote = $conn->prepare('select * from Quotes where quote_Id=?');
					if(!$stmtMainQuote){
						die('Statement preparing failed: ' . $conn->error);
					}
					if(!$stmtMainQuote->bind_param("i",$QuoteIdFromURL)){
						die('Statement binding failed: ' . $conn->connect_error);
					}
					if(!$stmtMainQuote->execute()){
						die('Statement execution failed: ' . $stmtMainQuote->error);
					}else{
						$result = $stmtMainQuote->get_result();
						if($result->num_rows === 0){
							$resultset['MainQuote']=$QuoteIdFromURL;
						} else{
							$resultset['MainQuote'] = $result->fetch_all(MYSQLI_ASSOC);
						}
					}
					$stmtOtherQuotes = $conn->prepare('select quote_Id,left(replace(fn_RemoveHTMLTag(quote_Item),"\r\n"," "),70) as short_Quote from Quotes where quote_Id !=?');
					if(!$stmtOtherQuotes){
						die('Statement preparing failed: ' . $conn->error);
					}
					if(!$stmtOtherQuotes->bind_param("i",$QuoteIdFromURL)){
						die('Statement binding failed: ' . $conn->connect_error);
					}
					if(!$stmtOtherQuotes->execute()){
						die('Statement execution failed: ' . $stmtOtherQuotes->error);
					}else{
						$result = $stmtOtherQuotes->get_result();
						if($result->num_rows === 0){
							$resultset['Quotes']='No rows';
						} else{
							$resultset['Quotes'] = $result->fetch_all(MYSQLI_ASSOC);
						}
					}
	}

	function getVideos(&$conn,&$id,&$resultset){
		$VideoIdFromURL =$_POST['Itemid'];
					if($VideoIdFromURL==0){
						$MaxLimit = $conn->prepare('select max(video_Id) as max from content__videos');
						if(!$MaxLimit){
							die('Statement preparing failed: ' . $conn->error);
						}
						if(!$MaxLimit->execute()){
							die('Statement execution failed: ' . $MaxLimit->error);
						}else{
							$resultMaxVideoId = $MaxLimit->get_result();
							if($resultMaxVideoId->num_rows === 0){
								$antwoord['resultMaxVideoId']='No rows';
							} else{
								$resultMaxVideoId = $resultMaxVideoId->fetch_all(MYSQLI_ASSOC);
							}
						}
						$VideoIdFromURL=rand(1,$resultMaxVideoId[0]['max']);
					}
					$stmtMainVideo = $conn->prepare('select * from content__videos where video_Id=?');
					if(!$stmtMainVideo){
						die('Statement preparing failed: ' . $conn->error);
					}
					if(!$stmtMainVideo->bind_param("i",$VideoIdFromURL)){
						die('Statement binding failed: ' . $conn->connect_error);
					}
					if(!$stmtMainVideo->execute()){
						die('Statement execution failed: ' . $stmtMainVideo->error);
					}else{
						$result = $stmtMainVideo->get_result();
						if($result->num_rows === 0){
							$resultset['MainVideo']=$VideoIdFromURL;
						} else{
							$resultset['MainVideo'] = $result->fetch_all(MYSQLI_ASSOC);
						}
					}
					$stmtOtherVideos = $conn->prepare('select * from content__videos where video_Id !=?');
					if(!$stmtOtherVideos){
						die('Statement preparing failed: ' . $conn->error);
					}
					if(!$stmtOtherVideos->bind_param("i",$VideoIdFromURL)){
						die('Statement binding failed: ' . $conn->connect_error);
					}
					if(!$stmtOtherVideos->execute()){
						die('Statement execution failed: ' . $stmtOtherVideos->error);
					}else{
						$result = $stmtOtherVideos->get_result();
						if($result->num_rows === 0){
							$resultset['Videos']='No rows';
						} else{
							$resultset['Videos'] = $result->fetch_all(MYSQLI_ASSOC);
						}
					}
	}

	function getEpisodeData(&$conn,&$API_Item,&$resultset){
		$stmtSerial = $conn->prepare("select * from Serials where serial_Id=?");
					if(!$stmtSerial){
						die("Statement prepare failed: " . $conn->connect_error);
					}
					
					if(!$stmtSerial->bind_param("i",$API_Item)){
						die("Statement binding failed: " . $conn->connect_error);
					}
					if(!$stmtSerial->execute()){
						die("Statement execution failed: " . $stmtSerial->error);
					}else{
						//return de json data
						$result = $stmtSerial->get_result();
						if($result->num_rows === 0){
							$resultset['Serial']="No Serial found";
						}else{
							$resultset['Serial'] = $result->fetch_all(MYSQLI_ASSOC);
							$stmtSerial->close();
							$stmtEpisodes = $conn->prepare("select *,time_format(SEC_TO_TIME(episode_Runtime_in_seconds),'%T') as Runtime from Episodes_With_State where episode_Serial_Id=? order by episode_Order");
							if(!$stmtEpisodes){
								die("Statement prepare failed: " . $conn->connect_error);
							}
							if(!$stmtEpisodes->bind_param("i",$API_Item)){
								die("Statement binding failed: " . $conn->connect_error);
							}
							if(!$stmtEpisodes->execute()){
								die("Statement execution failed: " . $stmtEpisodes->error);
							}else{
								$result = $stmtEpisodes->get_result();
								if($result->num_rows === 0){
									$resultset['Serial']['Episodes'] = "No Episodes found";
								}else{
									$resultset['Serial']['Episodes'] = $result->fetch_all(MYSQLI_ASSOC);
									$stmtEpisodes->close();
									$stmtCharacters = $conn->prepare("select Characters_With_Actor.*,SC_Type from api__serials_characters inner join Characters_With_Actor on Characters_With_Actor.character_Id=api__serials_characters.SC_Character_Id where api__serials_characters.SC_Serial_Id=?");
									if(!$stmtCharacters){
										die("Statement prepare failed: " . $conn->connect_error);
									}
									if(!$stmtCharacters->bind_param("i",$API_Item)){
										die("Statement binding failed: " . $conn->connect_error);
									}
									if(!$stmtCharacters->execute()){
										die("Statement execution failed: " . $stmtCharacters->error);
									}else{
										//return de json data
										$result = $stmtCharacters->get_result();
										if($result->num_rows === 0){
											$resultset['Serial']['Characters'] = "";
										}else{
											$resultset['Serial']['Characters'] = $result->fetch_all(MYSQLI_ASSOC);
										}
									}
									$stmtCrew = $conn->prepare("select api__crew.* from api__serials_crew inner join api__crew on api__crew.crew_Id=api__serials_crew.SC_crew_Id where api__serials_crew.SC_Serial_Id=?");
									if(!$stmtCrew){
										die("Statement prepare failed: " . $conn->connect_error);
									}
									if(!$stmtCrew->bind_param("i",$API_Item)){
										die("Statement binding failed: " . $conn->connect_error);
									}
									if(!$stmtCrew->execute()){
										die("Statement execution failed: " . $stmtCharacters->error);
									}else{
										//return de json data
										$result = $stmtCrew->get_result();
										if($result->num_rows === 0){
											$resultset['Serial']['Crew'] = "No Characters for this episode";
										}else{
											$resultset['Serial']['Crew'] = $result->fetch_all(MYSQLI_ASSOC);
										}
									}
								}
							}
						}
						$stmtEpisodeQuote = $conn->prepare('select * from Quotes where Serial_Id=?');
						if(!$stmtEpisodeQuote){
							die('Statement preparing failed: ' . $conn->error);
						}
						if(!$stmtEpisodeQuote->bind_param("i",$API_Item)){
							die('Statement binding failed: ' . $conn->connect_error);
						}
						if(!$stmtEpisodeQuote->execute()){
							die('Statement execution failed: ' . $stmtEpisodeQuote->error);
						}else{
							$result = $stmtEpisodeQuote->get_result();
							if($result->num_rows === 0){
								$resultset['Serial']['EpisodeQuotes']=$API_Item;
							} else{
								$resultset['Serial']['EpisodeQuotes'] = $result->fetch_all(MYSQLI_ASSOC);
							}
						}
					}
	}

	function buildSiteMap(&$conn,&$resultset){
		$stmtMap = $conn->prepare("SELECT page_Id,page_Link,page_Name,page_parent_id,exists(select 1 from management__pages t1 where t1.page_Parent_Id = management__pages.page_Id) collapsible FROM `management__pages` order by page_parent_id asc,collapsible desc,page_Order asc,page_Name asc");
						if(!$stmtMap){
								die("Statement preparing failed: " . $conn->error);
						}
						if(!$stmtMap->execute()){
								die("Statement execution failed: " . $stmtMap->error);
						}else{
								//return de json data
								$result = $stmtMap->get_result();
								if($result->num_rows === 0) {
									$resultset['Sitemap'] = "No Sitemap found";

								}else{
									$resultset['Sitemap'] = $result->fetch_all(MYSQLI_ASSOC);

								}
						}
						$stmtMap->close();
	}

	function getSmartContent(&$prefix){

	}

	function getSubPages(&$conn,&$current_Page_Id,&$resultset){
		$stmtChildPages = $conn->prepare('SELECT page_Link,page_Name FROM management__pages where page_Parent_Id=? AND Page_Active=1 order by page_Order,page_Name');
			if(!$stmtChildPages){
				die('Statement preparing failed: ' . $conn->error);
			}
			if(!$stmtChildPages->bind_param("i",$current_Page_Id)){
				die('Statement binding failed: ' . $conn->connect_error);
			}
			if(!$stmtChildPages->execute()){
				die('Statement execution failed: ' . $stmtChildPages->error);
			}else{
				$result = $stmtChildPages->get_result();
				if($result->num_rows === 0){
					$resultset['ChildPages']="";
				} else{
					$resultset['ChildPages'] = $result->fetch_all(MYSQLI_ASSOC);
				}
			}
			$stmtChildPages->close();
	}

	function getPath(&$conn,&$current_Page_Id,&$resultset){
		$stmtPathArray = $conn->prepare("SELECT `GetAncestry`(?) AS 'parents'");
			if(!$stmtPathArray){
					die("Statement preparing failed: " . $conn->error);
			}
			if(!$stmtPathArray->bind_param("i",$current_Page_Id)){
					die("Statement binding failed: " . $conn->connect_error);
			}
			if(!$stmtPathArray->execute()){
					die("Statement execution failed: " . $stmtPathArray->error);
			}else{
					//return de json data
				$result = $stmtPathArray->get_result();
				if($result && ($result->num_rows === 0)){
					$parents = $antwoord['Path'][0]['parents']=0;
				}else{
					$antwoord['Path'] = $result->fetch_all(MYSQLI_ASSOC);
					$parents = $antwoord['Path'][0]['parents'];
					$parentsarray = explode(',', $parents);
					$resultArray = array_map('intval', array_filter($parentsarray, 'is_numeric'));
				}
			}
			$stmtPathArray->close();
			if(count($resultArray)>0){
				$in  = str_repeat('?,', count($resultArray) - 1) . '?';
				$sql = "SELECT page_Link,page_Name from management__pages where page_Id in ($in) order by page_Parent_Id asc";
				$stmtPath = $conn->prepare($sql);
				if(!$stmtPath){
					die("Statement preparing failed: " . $conn->error);
				}
				$types = str_repeat('s', count($resultArray));
				if(!$stmtPath->bind_param($types,...$resultArray)){
					die("Statement binding failed: " . $conn->connect_error);
				}
				if(!$stmtPath->execute()){
						die("Statement execution failed: " . $stmtPath->error);
				}else{
						//return de json data
						$result = $stmtPath->get_result();
						if($result->num_rows === 0){}
							else{
								$resultset['Path'] = $result->fetch_all(MYSQLI_ASSOC);
							}
				}
				$stmtPath->close();
			}else{
				$resultset['Path'] = "";
			}
	}

	function getEpisodeOfTheDay(&$conn,&$resultset){
		$resultset['EpisodesOf_The_day'] = "Geen resultaten gevonden.";
		$stmtEOTD = $conn->prepare("SELECT * from Episodes_Of_The_Day where EXTRACT( MONTH FROM episode_Original_airdate)=EXTRACT( MONTH FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels')) and EXTRACT( day FROM episode_Original_airdate)=EXTRACT( day FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels'))");//prepare de query (maak de query zonder de variabelen op te nemen)
			if(!$stmtEOTD){
				die("Statement preparing failed: " . $conn->error);
			}
		if(!$stmtEOTD->execute()){
			die("Statement execution failed: " . $stmtEOTD->error);
		}else{
			//return de json data
			$result = $stmtEOTD->get_result();
			if($result->num_rows === 0){
				$resultset['EpisodesOf_The_day'] = "";

			} else{
				$resultset['EpisodesOf_The_day'] = $result->fetch_all(MYSQLI_ASSOC);

			}
		}
		$stmtEOTD->close();
	}



	function getActorsOfTheDay(&$conn,&$resultset){
		$resultset['ActorsOf_The_day'] = "Geen resultaten gevonden.";
		$stmtAOTD = $conn->prepare("SELECT *,IF(EXTRACT( MONTH FROM actor_Birthdate)=EXTRACT( MONTH FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels')) and EXTRACT( day FROM actor_Birthdate)=EXTRACT( day FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels')),'Birthday','In Memoriam') as Type from Actors_With_Link where (EXTRACT( MONTH FROM actor_Birthdate)=EXTRACT( MONTH FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels')) and EXTRACT( day FROM actor_Birthdate)=EXTRACT( day FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels'))) OR (EXTRACT( MONTH FROM actor_Deathdate)=EXTRACT( MONTH FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels')) and EXTRACT( day FROM actor_Deathdate)=EXTRACT( day FROM CONVERT_TZ(CURRENT_TIMESTAMP(),'GMT','Europe/Brussels')));");//prepare de query (maak de query zonder de variabelen op te nemen)
			if(!$stmtAOTD){
				die("Statement preparing failed: " . $conn->error);
			}
		if(!$stmtAOTD->execute()){
			die("Statement execution failed: " . $stmtAOTD->error);
		}else{
			//return de json data
			$result = $stmtAOTD->get_result();
			if($result->num_rows === 0){
				$resultset['ActorsOf_The_day'] = "";

			} else{
				$resultset['ActorsOf_The_day'] = $result->fetch_all(MYSQLI_ASSOC);

			}
		}
		$stmtAOTD->close();
	}



function getPagesForTag($conn,$current_Page_Id,$RawCategory,&$resultset){
	$stmtPagesByTags = $conn->prepare('select page_Link,page_Name, management__categories.category_Name from management__pages inner join management__pages_categories on page_Id = Pc_Page_Id 
	inner join management__categories on management__categories.category_Id=management__pages_categories.PC_category_Id
	where (PC_Category_Id=? or category_Name=?) and Page_Active=1;');
	if(!$stmtPagesByTags){
		die('Statement preparing failed: ' . $conn->error);
	}
	if(!$stmtPagesByTags->bind_param("is",$current_Page_Id,$RawCategory)){
		die('Statement binding failed: ' . $conn->connect_error);
	}
	if(!$stmtPagesByTags->execute()){
		die('Statement execution failed: ' . $stmtPagesByTags->error);
	}else{
		$rsltPagesByTag = $stmtPagesByTags->get_result();
		if($rsltPagesByTag->num_rows === 0){
			$resultset['PagesForTag']='No rows';
		} else{
			$resultset['PagesForTag'] = $rsltPagesByTag->fetch_all(MYSQLI_ASSOC);
		}
	}

}



	function getTags($conn,$current_Page_Id,&$resultset){
		$stmtTags = $conn->prepare('select category_Name,concat("Category:",replace(category_Name," ","_"),".html") as category_Link from management__categories inner join management__pages_categories on PC_category_Id=category_Id where PC_page_Id=?');
			if(!$stmtTags){
				die('Statement preparing failed: ' . $conn->error);
			}
			if(!$stmtTags->bind_param("i",$current_Page_Id)){
				die('Statement binding failed: ' . $conn->connect_error);
			}
			if(!$stmtTags->execute()){
				die('Statement execution failed: ' . $stmtTags->error);
			}else{
				$result = $stmtTags->get_result();
				if($result->num_rows === 0){
					$resultset['Tags']='';
				} else{
					$resultset['Tags'] = $result->fetch_all(MYSQLI_ASSOC);
				}
			}
	}

	function getContent(&$conn,&$current_Page_Id,&$language,&$resultset){
		$stmtContent = $conn->prepare('SELECT * FROM content_With_Lang where item_Page=? and language_Name=?');
			if(!$stmtContent){
				die('Statement preparing failed: ' . $conn->error);
			}
			if(!$stmtContent->bind_param("is",$current_Page_Id,$language)){
				die('Statement binding failed: ' . $conn->connect_error);
			}
			if(!$stmtContent->execute()){
				die('Statement execution failed: ' . $stmtContent->error);
			}else{
				$resultContent = $stmtContent->get_result();
				if($resultContent->num_rows === 0){
					$resultset['Content']="";
				} else{
					$resultset['Content'] = $resultContent->fetch_all(MYSQLI_ASSOC);
				}
			}
			$stmtContent->close();
	}

	function getDownloads(&$conn,&$current_Page_Id,&$resultset) {
		$stmtDownloads = $conn->prepare('select * from Downloads where download_Page=?');
			if(!$stmtDownloads){
				die('Statement preparing failed: ' . $conn->error);
			}
			if(!$stmtDownloads->bind_param('i',$current_Page_Id)){
				die('Statement binding failed: ' . $conn->connect_error);
			}
			if(!$stmtDownloads->execute()){
				die('Statement execution failed: ' . $stmtDownloads->error);
			}else{
				$resultDownloads = $stmtDownloads->get_result();
				if($resultDownloads->num_rows === 0){
					$resultset['Downloads']='No rows';
				} else{
					$resultset['Downloads'] = $resultDownloads->fetch_all(MYSQLI_ASSOC);
				}
			}
			$stmtDownloads->close();
	}



?>