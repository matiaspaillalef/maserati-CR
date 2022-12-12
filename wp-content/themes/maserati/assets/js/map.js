var latitude = jQuery("#map").data("lat"); // latitud
var longitude = jQuery("#map").data("long"); //longitud

function initMap() {
  var cr = {
    lat: latitude,
    lng: longitude,
  };

  var mapOptions = {
    zoom: 18,
    center: cr,
    fullscreenControl: false,
    zoomControl: false,
    mapTypeControl: false,
    scaleControl: false,
    streetViewControl: false,
    rotateControl: false,
    disableDefaultUI: true,
  };

  var that = this;

  this.map = new google.maps.Map(document.getElementById("map"), mapOptions);

  //Loads custom zoom controls
  var zoomDiv = document.createElement("div");
  var renderZoomControls = new ZoomControl(zoomDiv, this.map);
  zoomDiv.index = 1;
  this.map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(zoomDiv);

  //var InfoWindows = new google.maps.InfoWindow({});
  var marker = new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map: map,
    icon: "https://maserati.somosforma.dev/wp-content/themes/maserati/assets/img/pin-map.png?w=65",
  });

  if (window.outerWidth < 768) {
    marker.addListener("click", modalShowInfo);

    function modalShowInfo() {
      jQuery("body").toggleClass("open-info-map");
      jQuery(".sidebar-overlay").addClass("active");
    }
  }
}

window.initMap = initMap;

function ZoomControl(div, map) {
  var controlDiv = div;
  controlDiv;
  // Set CSS for the controls.
  controlDiv.style.cursor = "pointer";
  controlDiv.style.position = "absolute";
  controlDiv.style.display = "flex";
  controlDiv.style.flexDirection = "column";
  controlDiv.style.zIndex = "9";
  controlDiv.style.marginRight = "15px";

  var zoomout = document.createElement("div");
  zoomout.title = "Click to zoom out";
  controlDiv.appendChild(zoomout);

  var zoomoutText = document.createElement("div");
  zoomoutText.innerHTML = "<i class='bi bi-dash'></i>";
  zoomoutText.style.fontSize = "35px";
  zoomoutText.style.borderRadius = "100%";
  zoomoutText.style.textAlign = "center";
  zoomoutText.style.color = "#0c2340";
  zoomoutText.style.width = "50px";
  zoomoutText.style.height = "50px";
  zoomoutText.style.display = "flex";
  zoomoutText.style.alignItems = "center";
  zoomoutText.style.justifyContent = "center";
  zoomoutText.style.backgroundColor = "white";
  zoomout.appendChild(zoomoutText);

  var zoomin = document.createElement("div");
  zoomin.title = "Click to zoom in";
  controlDiv.appendChild(zoomin);

  var zoominText = document.createElement("div");
  zoominText.innerHTML = "<strong><i class='bi bi-plus'></i></strong>";
  zoominText.style.fontSize = "35px";
  zoominText.style.borderRadius = "100%";
  zoominText.style.textAlign = "center";
  zoominText.style.color = "#0c2340";
  zoominText.style.width = "50px";
  zoominText.style.height = "50px";
  zoominText.style.display = "flex";
  zoominText.style.alignItems = "center";
  zoominText.style.justifyContent = "center";
  zoominText.style.backgroundColor = "white";
  zoominText.style.marginTop = "15px";
  zoomin.appendChild(zoominText);

  // Setup the click event listeners for zoom-in, zoom-out:
  google.maps.event.addDomListener(zoomout, "click", function () {
    var currentZoomLevel = map.getZoom();
    if (currentZoomLevel != 0) {
      map.setZoom(currentZoomLevel - 1);
    }
  });

  google.maps.event.addDomListener(zoomin, "click", function () {
    var currentZoomLevel = map.getZoom();
    if (currentZoomLevel != 21) {
      map.setZoom(currentZoomLevel + 1);
    }
  });
}
