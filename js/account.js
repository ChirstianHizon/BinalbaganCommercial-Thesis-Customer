var ordertb;
$(function() {
  console.log('SCRIPT RUNNING');

  ordertb = $('#order_id').DataTable({
    "responsive": true,
    "bLengthChange": false,
    "bInfo" : false,
    "bFilter": false,
    "pageLength": 10
  });

  getUserOrders();
  // google.maps.event.addDomListener(window, 'load', initializeMap);

});


// window.onload = function () {
//   var x = $('#userdetails').height();
//   console.log(x + 'px');
//
//   $('#customer_map').height(x);
// }



function getUserOrders(){
  $.ajax({
    url: "php/orders.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "type":1
    },success: function(result){
      console.log(result);
      ordertb.destroy();
      document.getElementById("order-body").innerHTML=result.main;
      document.getElementById("order-total").innerHTML=" P "+addCommas(get2decimal(result.total));
      ordertb = $('#order_id').DataTable({
        "responsive": true,
        "bLengthChange": false,
        "bInfo" : false,
        "bFilter": false,
        "pageLength": 5,
      });
    },error: function(response) {
      console.log(response);
    }
  });
  return false;
}


var directionsDisplay,directionsService,map,infoWindow,geocoder;
// -------------------------------- MAPS API ------------------------------------------//
function initializeMap() {
  // directionsDisplay = new google.maps.DirectionsRenderer();
  // directionsService = new google.maps.DirectionsService();
  var map = new google.maps.Map(document.getElementById('customer_map'), {
    zoom: 17,
    center: new google.maps.LatLng(10.194262, 122.862165),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  // directionsDisplay.setMap(map);
  infoWindow = new google.maps.InfoWindow;
  geocoder = new google.maps.Geocoder;
  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Current Location.');
      infoWindow.open(map);
      map.setCenter(pos);

      geocoder.geocode({'location': pos}, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
            map.setZoom(17);
            var marker = new google.maps.Marker({
              position: pos,
              map: map
            });
            infoWindow.setContent("Location: "+results[0].formatted_address);
            console.log(results[0].formatted_address);
            infoWindow.open(map, marker);
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });


      // console.log("Coord"+pos.lat+" | "+pos.lng);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}








//---------------------------------------- UTILITIES --------------------------------//
function addCommas(nStr) {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}
function get2decimal(int){
  return parseFloat(Math.round(int * 100) / 100).toFixed(2);
}
