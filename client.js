
//Check for serviceworker

if ('serviveWorker' in navigator) {
  send().catch(err => console.error(err));
}

//register SW,Register Push,Send Push
async function send() {
  console.log('registering ServixceWorker');
  const register = awaiting navigator.serviceWorker.register('/sw.js');
}