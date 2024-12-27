<?php session_start();
$_SESSION["Menu"]="";
$_SESSION["EmailSent"]="";
?>
<!Doctype html>
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
    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <title>
        Doctor Who Fans België
    </title>
    <meta name=author content="Ruben Debusscher" />
    <meta charset=UTF-8 />
    <meta http-equiv=X-UA-Compatible content="chrome=1, IE=edge">
    <meta naasyncasync    me="referrer" content="no-referrer-when-downgrade" />
    <meta name=viewport content="width=device-width, initial-scale=1.0" />
    <link rel="manifest" href="https://www.doctorwhofans.be/manifest.json"crossorigin="use-credentials">
    <meta name="theme-color" content="#306090"/>
    <link rel="apple-touch-icon" href="https://www.doctorwhofans.be/images/logo/apple-icon.png">


   
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107369097-3" type="application/javascript"></script>
<script type='application/javascript' >
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-107369097-3');
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WH80PEG0ZG"  type="application/javascript"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WH80PEG0ZG');
</script>

    <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--     <script>window.jQuery || document.write('<script src="https://www.doctorwhofans.be/trumbowyg/js/vendor/jquery-3.3.1.min.js"><\/script>')</script> -->


    <script src="https://www.doctorwhofans.be/js/new.js"></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e66a481fb4445001239b600&product=inline-share-buttons' async='async'></script>

    <link rel="stylesheet" href="https://www.doctorwhofans.be/css/main.css" />


        <link href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" rel="stylesheet" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>
<script src="https://www.doctorwhofans.be/js/baguetteBox.min.js"></script>


<link rel="stylesheet" href="https://www.doctorwhofans.be/css/baguetteBox.min.css" />
<script type='application/javascript' type="module" async='async'>

let deferredPrompt;

    window.addEventListener('beforeinstallprompt', function(event) {
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        event.preventDefault();
        // Stash the event so it can be triggered later.
        deferredPrompt = event;
    });

    // Installation must be done by a user gesture! Here, the button click
    $(".installButton").on('click', (e) => {
        // hide our user interface that shows our A2HS button
        $(".installButton").hide();
        // Show the prompt
        deferredPrompt.prompt();
        // Wait for the user to respond to the prompt
        deferredPrompt.userChoice
        .then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
            console.log('User accepted the A2HS prompt');
            } else {
            console.log('User dismissed the A2HS prompt');
            }
            deferredPrompt = null;
        });
    });


        async function SW(){
            console.log("test");
            //if ('serviceWorker' in navigator) {
                //await navigator.serviceWorker.register('/sw.js');
                //console.log(sw);
           // }

        }

        if ('serviceWorker' in navigator) {

navigator.serviceWorker.register(
  '/sw.js',
  { scope: './' }
).then( function() {
  var serviceWorker;

  console.log('successful');

  //if (registration.installing) {
  //  serviceWorker = registration.installing;
  //} else if (registration.waiting) {
  //  serviceWorker = registration.waiting;
  //} else if (registration.active) {
   // serviceWorker = registration.active;
 // }

  if (serviceWorker) {

    serviceWorker.addEventListener('statechange', function(e) {
      console.log(e.target.state);
    });
  }
}).catch(function(error) {
    console.log(error);
});
} else {
    console.log('unavailable');
}
        async function subscribe(){
            let sw = await navigator.serviceWorker.ready;
            let push = await sw.pushManager.subscribe({
                userVisibleOnly:true,
                applicationServerKey:'BAZuh0JHL2M50rX6FSoS-YIRVP6MG1px1f33YAFfxeAEAm40F1xq-Fk8jRe8qV-sJwkCWCux0YWD-acG-HAoWIc'
            })
            //console.log(JSON.stringify(push));
           // console.log(sw);
        }
       
        </script>
</head>

<body>
<a href="#SiteContent" class="sr-only skip">Skip to content</a>

    <?php
        $lang = substr($_COOKIE['lang'], 0, 2);
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
    
    <script type="application/javascript" src="https://sdki.truepush.com/sdk/v2.0.4/app.js" async></script>
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
 </script>
 <script defer src="https://www.gofundme.com/static/js/embed.js"></script>

</body>

</html>

