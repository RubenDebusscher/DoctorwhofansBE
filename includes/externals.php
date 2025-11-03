<link rel="manifest" href="https://www.doctorwhofans.be/manifest.json" crossorigin="use-credentials">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107369097-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() { dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', 'UA-107369097-3');
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WH80PEG0ZG"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() { dataLayer.push(arguments); }
  gtag('js', new Date());

  gtag('config', 'G-WH80PEG0ZG');
</script>

<!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--     <script>window.jQuery || document.write('<script src="https://www.doctorwhofans.be/trumbowyg/js/vendor/jquery-3.3.1.min.js"><\/script>')</script> -->
<script src="<?php echo getenv('APP_DOMAIN') ?>/js/new.js"></script>
<script src='https://platform-api.sharethis.com/js/sharethis.js#property=5e66a481fb4445001239b600&product=inline-share-buttons' async='async'></script>

<link rel="stylesheet" href="<?php echo getenv('APP_DOMAIN') ?>/css/main.css" />


<link href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" rel="stylesheet" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>
<script src="<?php echo getenv('APP_DOMAIN') ?>/js/baguetteBox.min.js"></script>


<link rel="stylesheet" href=<?php echo getenv('APP_DOMAIN') ?>/css/baguetteBox.min.css" />
<script type="module" async='async'>

  let deferredPrompt;

  window.addEventListener('beforeinstallprompt', function (event) {
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


  async function SW() {
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
    ).then(function () {
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

        serviceWorker.addEventListener('statechange', function (e) {
          console.log(e.target.state);
        });
      }
    }).catch(function (error) {
      console.log(error);
    });
  } else {
    console.log('unavailable');
  }
  async function subscribe() {
    let sw = await navigator.serviceWorker.ready;
    let push = await sw.pushManager.subscribe({
      userVisibleOnly: true,
      applicationServerKey: 'BAZuh0JHL2M50rX6FSoS-YIRVP6MG1px1f33YAFfxeAEAm40F1xq-Fk8jRe8qV-sJwkCWCux0YWD-acG-HAoWIc'
    })
    //console.log(JSON.stringify(push));
    // console.log(sw);
  }

</script>