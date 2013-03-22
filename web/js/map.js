var map;
var markersArray = [];
var lat = 13.3;
var lng = -89;

$(function(){
	$(".bot-tab").hide();
	$(".tab-1").show();
	
	initialize();
	
	locations(0,"","");
	
});

$(document).ready(function() {
	geoLocation();
});

function initialize() {
    var mapOptions = {
      zoom: 5,
      center: new google.maps.LatLng(lat,lng),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map'),
        mapOptions);
}

function geoposition(proxy,code,latName,lngName,zoom) {
	if(code == "Select" || code == ""){
		map.setZoom(5);
	}else{
		url = 'http://api.geonames.org/getJSON?username=wowfi&lang=ES&geonameId='+code;
		
		$.getJSON(proxy,{url:url}, function(data){
	        lat = data.contents.lat;
			lng = data.contents.lng;
			$("#"+latName).val(lat);
			$("#"+lngName).val(lng);
			map.setCenter(new google.maps.LatLng(lat,lng));
			map.setZoom(zoom);
	    });
	}
	
}
function locations(materialType,region,band){
	deleteOverlays();
	$.getJSON('/dondereciclo/web/app_dev.php/dondereciclo/points',{ materialType : materialType },  function(data){
    	$.each(data.content , function(i, item){
			addMarker(item);
    	});
	})
	.error(function() { alert("Unexpected Error"); })
	.complete(function() { });
}

function addMarker(item) {
	 var marker = new google.maps.Marker({
		position: new google.maps.LatLng(item.lat,item.lng),
		title: item.placeName,
		animation: google.maps.Animation.DROP,
	    map: map
	 });
	 var cadena_html =
	    "<table>"+
	    	"<tr><td ><span>Place name:</span></td><td>"+item.placeName+"</td></tr>"+
	    	"<tr><td ><span>Contact Email:</span></td><td>"+item.contactEmail+"</td></tr>"+
	    	"<tr><td ><span>Contact Phone:</span></td><td>"+item.contactPhone+"</td></tr>"+
	    	"<tr><td ><span>Address:</span></td><td>"+item.address+"</td></tr>"+
	    	"<tr><td ><span>Website:</span></td><td>"+item.website+"</td></tr>"+
	    	"<tr><td ><span>Country:</span></td><td>"+item.countryGeonameId+"</td></tr>"+
	    	"<tr><td ><span>State:</span></td><td>"+item.stateGeonameId+"</td></tr>"+
	    	"<tr><td ><span>City:</span></td><td>"+item.cityGeonameId+"</td></tr>"+
	     "</table>";
	  var infowindow = new google.maps.InfoWindow(
	      {
	        content: "<div>"+cadena_html+"</div>"
	      });
	  google.maps.event.addListener(marker, 'click', function() {
		  infowindow.open(map,marker);
	  });
	 
	  markersArray.push(marker);
}
// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
  }
}

// Shows any overlays currently in the array
function showOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(map);
    }
  }
}

// Deletes all markers in the array by removing references to them
function deleteOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
    markersArray.length = 0;
  }
}
function geoLocation(){
	navigator.geolocation.getCurrentPosition(function(position) {
		
        lat = position.coords.latitude; 
        lng = position.coords.longitude;
        map.setCenter(new google.maps.LatLng(lat,lng));
    });
}
		