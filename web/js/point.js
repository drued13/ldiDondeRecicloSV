var map;
var market;

function initialize() 
{
    var mapOptions = {
      zoom: 5,
      center: new google.maps.LatLng($("#lat").val(),$("#lng").val()),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(document.getElementById('map'),
        mapOptions);
    
    var input = document.getElementById('searchTextField');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker2 = new google.maps.Marker({
      map: map
    });
    
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        infowindow.close();
        marker2.setVisible(false);
        input.className = '';
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          // Inform the user that the place was not found and return.
          input.className = 'notfound';
          return;
        }
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);  // Why 17? Because it looks good.
        }
        var image = new google.maps.MarkerImage(
            place.icon,
            new google.maps.Size(71, 71),
            new google.maps.Point(0, 0),
            new google.maps.Point(17, 34),
            new google.maps.Size(35, 35));
        marker2.setIcon(image);
        marker2.setPosition(place.geometry.location);

        var address = '';
        if (place.address_components) {
          address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker2);
      });
    autocomplete.setTypes([]);
    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
      var radioButton = document.getElementById(id);
      google.maps.event.addDomListener(radioButton, 'click', function() {
        autocomplete.setTypes(types);
      });
    }

	marker = new google.maps.Marker({
      position: new google.maps.LatLng($("#lat").val(),$("#lng").val()),
	  draggable: true,
	  title: "Wowfi Location",
      map: map
    });
    google.maps.event.addListener(map, 'click', function(e) {
    	marker.setPosition(e.latLng);
    	$("#lat").val(marker.getPosition().lat().toString());
		$("#lng").val(marker.getPosition().lng().toString());
    });
	google.maps.event.addListener(marker, 'dragend', function() {
		$("#lat").val(marker.getPosition().lat().toString());
		$("#lng").val(marker.getPosition().lng().toString());
	});
}
function geoposition(proxy,code,latName,lngName,zoom) 
{
	url = 'http://api.geonames.org/getJSON?username=wowfi&geonameId='+code;

	$.getJSON(proxy,{url:url}, function(data){
        var lat = data.contents.lat;
		var lng = data.contents.lng;
		$("#"+latName).val(lat);
		$("#"+lngName).val(lng);
		map.setCenter(new google.maps.LatLng(lat,lng));
		marker.setPosition(new google.maps.LatLng(lat,lng));
		map.setZoom(zoom);
    });
}
$(function(){
	initialize();
	
	loadCountries("/dondereciclo/web/scripts/proxy.php","countryGeonameId");

	$("#countryGeonameId").change(function(){
		geoposition("/dondereciclo/web/scripts/proxy.php",$("#countryGeonameId option:selected").val(),"lat","lng",7);
		loadStates("/dondereciclo/web/scripts/proxy.php",$("#countryGeonameId option:selected").attr("countryCode"), "stateGeonameId");
	});

	$("#stateGeonameId").change(function(){
		geoposition("/dondereciclo/web/scripts/proxy.php",$("#stateGeonameId option:selected").val(),"lat","lng",9);
		loadCities("/dondereciclo/web/scripts/proxy.php",$("#countryGeonameId option:selected").attr("countryCode"),$("#stateGeonameId option:selected").attr("adminCode1"),"cityGeonameId");
	});

	$("#cityGeonameId").change(function(){
		geoposition("/dondereciclo/web/scripts/proxy.php",$("#cityGeonameId option:selected").val(),"lat","lng",12);	
	});
});