var watchId = -1;
const demo = document.getElementById('demo');

function error(err) {
        demo.innerHTML = `Failed to locate. Error: ${err.message}`;
}

function success(pos) {
  alert(`latitude: ${pos.coords.latitude}
  \n longitude: ${pos.coords.longitude}
  \n accuracy: ${pos.coords.accuracy}`);
}

function watchPosition() {
  if (navigator.geolocation) {
     demo.innerHTML = 'Watching...';
     watchId = navigator.geolocation.watchPosition(success);
  } else { 
        demo.innerHTML = 'Geolocation is not supported by this browser.';
  }
}
      
function stopWatching() {
  if (navigator.geolocation) {
     demo.innerHTML = 'Stopped';
     navigator.geolocation.clearWatch(watchId);
  } else { 
        demo.innerHTML = 'Geolocation is not supported by this browser.';
  }
}