<?php session_start();
$_SESSION["Menu"]="";?>
<!Doctype>
<?php

    if(isset($_GET['menu'])){
        $menu=htmlentities($_GET['menu'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
    }else if ($_SESSION["Menu"] !==""){
        $menu=$_SESSION["Menu"];
    }else{
        $menu= "Home";
    }
    if(isset($_GET['id'])){
        $id= htmlentities($_GET['id'], ENT_QUOTES | ENT_IGNORE, "UTF-8");
    }else{$id=0;}
?>
<html lang="nl-BE">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>
        Doctor Who Fans België
    </title>
    <meta name=author content="Ruben Debusscher" />
    <meta charset=UTF-8 />
    <meta http-equiv=X-UA-Compatible content="chrome=1, IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1.0" />
    <link rel="manifest" href="https://www.doctorwhofans.be/manifest.json">
    <meta name="theme-color" content="#306090"/>
    <link rel="apple-touch-icon" href="https://ww.doctorwhofans.be/images/logo/apple-icon.png">
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', async ()=> {
                let sw = await navigator.serviceWorker.register('https://www.doctorwhofans.be/sw.js');
                console.log(sw);
            })
        }
        async function subscribe(){
            let sw = await navigator.serviceWorker.ready;
            let push = await sw.pushManager.subscribe({
                userVisibleOnly:true,
                applicationServerKey:'BAZuh0JHL2M50rX6FSoS-YIRVP6MG1px1f33YAFfxeAEAm40F1xq-Fk8jRe8qV-sJwkCWCux0YWD-acG-HAoWIc'
            })
            console.log(JSON.stringify(push));
            console.log(sw);
        }
        </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107369097-3"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-107369097-3');
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WH80PEG0ZG"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WH80PEG0ZG');
</script>

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--     <script>window.jQuery || document.write('<script src="https://www.doctorwhofans.be/trumbowyg/js/vendor/jquery-3.3.1.min.js"><\/script>')</script> -->


    <script src="https://www.doctorwhofans.be/js/new.js"></script>


    <link rel="stylesheet" href="https://www.doctorwhofans.be/css/main.css" />
    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5e66a481fb4445001239b600&product=inline-share-buttons"
        async="async" async defer></script>
</head>

<body>
<a href="#SiteContent" class="sr-only skip">Skip to content</a>

    <?php
        include_once 'includes/nav.html';
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
    <script type="application/javascript" src="https://sdki.truepush.com/sdk/v2.0.3/app.js" async></script>
    <script>
    var truepush = window.truepush || [];
    truepush.push(function(){
        truepush.Init({
            id: "62877acc88e61fd3932d116a"
        },function(error){
            if(error) console.error(error);
        })
    })
    </script>
</body>

</html>

