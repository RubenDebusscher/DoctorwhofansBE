<?php session_start();
$_SESSION["Menu"]="";
$_SESSION["EmailSent"]="";
?>
<!Doctype html>
<?php
    require_once 'php/header_logic.php';
    $lang = substr($_COOKIE['lang'], 0, 2);

?>
<html lang="nl-BE">

<head>
    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <title>
        Doctor Who Fans België
    </title>
    <script>
        window.APP_ENV = {
            DOMAIN: "<?php echo htmlspecialchars($_ENV['APP_DOMAIN'], ENT_QUOTES) ?>",
            SHORT_DOMAIN: "<?php echo htmlspecialchars($_ENV['SHORT_DOMAIN'], ENT_QUOTES) ?>",
            APP_ENV: "<?php echo htmlspecialchars($_ENV['APP_ENV'], ENT_QUOTES) ?>"
        };
        </script>
    <meta name=author content="Ruben Debusscher" />
    <meta charset=UTF-8 />
    <meta http-equiv=X-UA-Compatible content="chrome=1, IE=edge">
    <meta name="referrer" content="no-referrer-when-downgrade" />
    <meta name=viewport content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#306090"/>
    <link rel="apple-touch-icon" href="https://www.doctorwhofans.be/images/logo/apple-icon.png">
    <?php
        require_once 'includes/externals.php';

    ?>
    
</head>

<body>
<a href="#SiteContent" class="sr-only skip">Skip to content</a>

    <?php
        
        include('translations/'. $lang . '.php');
        include_once 'includes/nav.php';
        include_once 'includes/main.html';
        include_once 'includes/overlays.html';
        include_once 'includes/footer.html';

        //TODO #66 add fist and lastepisode (both regular and departure/regeneration)
        //TODO #67 add books/magazines/comics to DB
        //TODO #68 add audio (big finish,...)
        //TODO #69 create list of episodes by characteristics
        //TODO #70 create list of cast per episode
        //TODO #71 create list of crew per episode
        //TODO #72 add different kinds of episodes (minisodes, spin offs,...)
    ?>
<script>
        setDarkModeFromCookie();
        setFontFromCookie();
        if (getCookie("size") != "") {
            getSizesFromCookie();
        }
        var menu = "<?php echo $menu?>";
        var id=Number("<?php echo $id?>");
        if (menu==""){
            menu="Home"
        }
        var main_path='https://www.doctorwhofans.be';
        //getAvailableLangcodes();
        //checkCookie()
    </script>
    
   <!--  <script type="application/javascript" src="https://sdki.truepush.com/sdk/v2.0.4/app.js" async></script>
    <script>
    var truepush = window.truepush || [];
            
    truepush.push(function(){
        truepush.Init({
            id: "655e5786a4fa09cdff61b43e"
        },function(error){
          if(error) console.error(error);
        })
    })
    </script>



<script>
 truepush.push({
     operation: "add-tags",
     data: [{ tagName: "LANGUAGE", tagType: "string", tagValue: getCookie("lang") }],
     callback: function(error,response){
                 console.log(error,response);
         }
 })
 </script> -->
 <script defer src="https://www.gofundme.com/static/js/embed.js"></script>

</body>

</html>

