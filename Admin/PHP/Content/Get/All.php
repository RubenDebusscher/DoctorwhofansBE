<?php
    require("../../cors.php");
	require("../../connect.php");
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
   $antwoord = [];
	$antwoord['data'] = "Geen resultaten gevonden.";
	mysqli_set_charset($conn,'utf8');
	
	$verified=false;
	$stmt1 = $conn->prepare("SELECT * from alles inner join Topics on A_Pagina=id limit 0,50");
	if(!$stmt1){
	    	    die("Statement preparing failed: " . $conn->error);

	}
	$menu =$_GET['menu'];
	
	if(!$stmt1->execute()){
	    die("Statement execution failed: " . $stmt1->error);
	}else{
	    //return de json data
	    $result = $stmt1->get_result();
	    if($result->num_rows === 0) exit('No rows');
        $antwoord['data'] = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($antwoord, JSON_UNESCAPED_UNICODE);
   
	}
    
    
    $stmt1->close();
    $conn->close();
?>