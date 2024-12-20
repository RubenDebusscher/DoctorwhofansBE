<?php
    require("cors.php");            //set cors
	require("PHP/connect.php");         //open connection
	if ($conn->connect_error) {     //check if there is any error in the connection, if so --> die
        die("Connection failed: " . $conn->connect_error);
    }     
    $antwoord = []; //maak een object aan
	$antwoord['data'] = "Geen resultaten gevonden."; //geef mee wat er in het object zit
	mysqli_set_charset($conn,'utf8'); //stel the charset in
	/* prepare de query (maak de query zonder de variabelen op te nemen)*/
	//$stmt1 = $conn->prepare("SELECT dayname(CONVERT_TZ(A_TIMESTAMP,'UTC','Europe/Brussels')) as day, concat(lpad(hour(CONVERT_TZ(A_TIMESTAMP,'UTC','Europe/Brussels')),2,0),' - ',lpad(hour(TIMESTAMPADD(hour,1,CONVERT_TZ(A_TIMESTAMP,'UTC','Europe/Brussels'))),2,0))as uur, count(A_Pagina) as elem  FROM `Content` group by day,uur order by weekday(CONVERT_TZ(A_TIMESTAMP,'UTC','Europe/Brussels')),uur");

	$stmt1 = $conn->prepare("SELECT page_Name, group_concat(management__categories.category_Name) as Tags FROM `management__pages` left join management__pages_categories on management__pages.page_Id=management__pages_categories.PC_page_Id left join management__categories on management__pages_categories.PC_category_Id=management__categories.category_Id group by page_Id;");
    
	if(!$stmt1){    //als het preparen mislukt --> die
        die("Statement preparing failed: " . $conn->error);
	}
	if(!$stmt1->execute()){    //voer de query uit
	    die("Statement execution failed: " . $stmt1->error);
	}
    else{
	    $result = $stmt1->get_result();	    //return de json data
	    if($result->num_rows === 0) exit('No rows');
        $antwoord['data'] = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);//zet het anwoord om in JSON
	}
    $stmt1->close();    //sluit de query en de connectie af
    $conn->close();
?>