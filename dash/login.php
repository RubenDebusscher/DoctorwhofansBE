<?php
include('../php/connect.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Username and Password sent from Form
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $password = md5($password);



    $stmt1 = $conn->prepare("SELECT * FROM management__users WHERE user_Name=? AND user_Password=?");
    
    if(!$stmt1){    //als het preparen mislukt --> die
        die("Statement preparing failed: " . $conn->error);
    }

    if(!$stmt1->bind_param("ss",$username,$password)){
        die("Statement binding failed: " . $stmt->error);
        //$conn->close();
    }
    if(!$stmt1->execute()){    //voer de query uit
        die("Statement execution failed: " . $stmt1->error);
    }else{
        $result = $stmt1->get_result();	    
    
        //If result match $username and $password Table row must be 1 row
        if($result->num_rows === 1)
        {
            $_SESSION["user"] = $username;
            //echo $_SESSION["user"];
            header("Location: welcome.php");
        }else{
            echo "Invalid Username or Password";
        }
        
    }
    $stmt1->close();
    $conn->close();





    
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard | Login</title>
<meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="manifest" href="manifest.json">
        <meta name="theme-color" content="#000090"/>
        <link rel="apple-touch-icon" href="images/logo/apple-icon.png">
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js').then(function(registration) {
                    // Registration was successful
                    //console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    }, function(err) {
                    // registration failed :(
                    console.error('ServiceWorker registration failed: ', err);
                    });
                });
            }
        </script>

<link rel="stylesheet" type="text/css" href="opmaak.css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdn.jsdelivr.net/remarkable/1.7.1/remarkable.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" 
      integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" 
      crossorigin="anonymous">
</script>
<script src="fancyTable.min.js"></script>

<script type="text/javascript" src="graph.js"></script>
<script>
    window.onload = function () {
    buildLogo('#logo', '#306090');
}
</script>
</head>
<body>
    <article style="width:fit-content;margin:auto">

    <div id="logo" style="width:20em;height:20em;background-repeat: no-repeat;
    background-size: contain;"></div>
<h1>Login</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<label>Username</label>
<input type="text" name="user"><br/><br/>
<label>Password</label>
<input type="password" name="pass"><br/><br/>
<input type="submit" name="submit" value="Login"><br/>
</form>

    </article>

</body>
</html>