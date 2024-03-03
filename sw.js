var self, $, importScripts;
var version = "v2.0.4";
var swPath;
var urlObject = new URL(location);
var host;
var workbox,caches,Promise;

function showInstallPromotion() {
    "use strict";
    $('.installButton').show();
}
if (urlObject.searchParams.get("swPath")) {
    swPath = urlObject.searchParams.get("swPath");
}
else {
    if (urlObject.searchParams.get("version")) {
        version = urlObject.searchParams.get("version");
    }
    if (urlObject.searchParams.get("swJSHost")) {
        host = "https://" + urlObject.searchParams.get("swJSHost");
    }




    else {
        host = "https://sdki.truepush.com/sdk/";
    }
    swPath = host + version + "/sw.js";
}
var CACHE_NAME = 'my-site-cache-v3';
var urlsToCache = [
  'https://www.doctorwhofans.be/css',
  'https://www.doctorwhofans.be/js',
  'https://www.doctorwhofans.be/images/',
  //'https://www.doctorwhofans.be/'
];
// @ts-ignore
var deferredPrompt;

self.addEventListener('beforeinstallprompt', function (event){
  event.preventDefault();
  deferredPrompt = event;
  showInstallPromotion();
});
//
importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.4.1/workbox-sw.js');




self.addEventListener('beforeinstallprompt', function (event){
  event.preventDefault();
  deferredPrompt = event;
  showInstallPromotion();
});
//
/* importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.4.1/workbox-sw.js');

self.addEventListener('fetch', event => {
  
// This will trigger the importScripts() for workbox.strategies and its dependencies:
workbox.loadModule('workbox-strategies');
  if (event.request.url.endsWith('.png')) {
    // Referencing workbox.strategies will now work as expected.
    const cacheFirst = new workbox.strategies.CacheFirst();
    event.respondWith(cacheFirst.handle({request: event.request}));
  }
  if (event.request.url.endsWith('.jpg')) {
    // Referencing workbox.strategies will now work as expected.
    const cacheFirst = new workbox.strategies.CacheFirst();
    event.respondWith(cacheFirst.handle({request: event.request}));
  }
  if (event.request.url.contains('doctorwhofans.be')) {
    // Referencing workbox.strategies will now work as expected.
     event.respondWith(
   caches.match(event.request)
      .then(function (response) {
      // Cache hit - return response
        if (response) {
          return response;
        }
        // IMPORTANT: Clone the request. A request is a stream and
        // can only be consumed once. Since we are consuming this
        // once by cache and once by the browser for fetch, we need
        // to clone the response.
        var fetchRequest = event.request.clone();
        return fetch(fetchRequest).then(
          function (response) {
          // Check if we received a valid response
            if ((!response || response.status !== 200 || response.type !== 'basic') && response.url.indexOf('/php/') ==-1) {
              return response;}
            var responseToCache = response.clone();

            caches.open(CACHE_NAME)
              .then(function (cache) {
                if(event.request=="GET"){
                  cache.put(event.request, responseToCache);
                }
              });

            // IMPORTANT: Clone the response. A response is a stream
            // and because we want the browser to consume the response
            // as well as the cache consuming the response, we need
            // to clone it so we have two streams.

            return response;
          }
        );
      })
  );
  }
}); */




self.addEventListener('install', function (event) {
  
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function (cache) {
        //console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('activate', function (event) {
  var cacheWhitelist = ['my-site-cache-v2'];
  event.waitUntil(
    caches.keys().then(function (cacheNames) {
      return Promise.all(
        cacheNames.map(function (cacheName) {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  console.log('service worker activate');

});


importScripts("https://sdki.truepush.com/sdk/v2.0.4/sw.js");