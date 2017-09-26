var ordertb;
var custlat = 10.194262,custlng = 122.862165;
$(function() {
  hide("#imageselector");
  console.log('SCRIPT RUNNING');

  ordertb = $('#order_id').DataTable({
    "responsive": true,
    "bLengthChange": false,
    "bInfo" : false,
    "bFilter": false,
    "pageLength": 10
  });

  getUserOrders();
  getUserDetails();
  // google.maps.event.addDomListener(window, 'load', initializeMap);
});


window.onload = function () {
  var x = $('#userdetails').height();
  console.log(x + 'px');

  $('#customer_map').height(x);
};


var file;
function getimage(event){
  file = event.target.files[0];
  console.log(file);
}

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
var custaddress;
function getUserDetails(){
  $.ajax({
    url: "php/customer.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "type":3
    },success: function(result){
      console.log(result);
      custaddress = result.address;

      document.getElementById('uname').value = result.name;
      document.getElementById('ufname').value = result.fname;
      document.getElementById('ulname').value = result.lname;
      document.getElementById('uaddress').value = result.address;
      document.getElementById('ucontact').value = result.contact;

      if(result.lat != "" && result != ""){
        custlat = result.lat;
        custlng = result.lng;
      }else{
        custlat = 10.194262;
        custlng = 122.862165;
      }
    },error: function(response) {
      console.log(response);
    }
  });
}
// 10.194262, 122.862165
var isonEdit = false;
var edtbutton = document.getElementById('editprofile');
edtbutton.addEventListener('click', function() {
  if(!isonEdit){
    show("#imageselector");
    edtbutton.innerHTML = "Save Profile";
    // document.getElementById('uname').disabled = false;
    document.getElementById('ufname').disabled = false;
    document.getElementById('ulname').disabled = false;
    document.getElementById('uaddress').disabled = false;
    document.getElementById('ucontact').disabled = false;
    isonEdit = true;
  }else{
    hide("#imageselector");
    upateCustomerDetails();
    edtbutton.innerHTML = "Edit Profile";
    // document.getElementById('uname').disabled = true;
    document.getElementById('ufname').disabled = true;
    document.getElementById('ulname').disabled = true;
    document.getElementById('uaddress').disabled = true;
    document.getElementById('ucontact').disabled = true;
    isonEdit = false;
    alert('Save Complete');
  }

}, false);


var edtcancel = document.getElementById('cancel');
edtcancel.addEventListener('click', function() {


  if(isonEdit){
    getUserDetails();
    hide("#imageselector");
    edtbutton.innerHTML = "Edit Profile";
    document.getElementById('ufname').disabled = true;
    document.getElementById('ulname').disabled = true;
    document.getElementById('uaddress').disabled = true;
    document.getElementById('ucontact').disabled = true;
    isonEdit = false;
  }

}, false);

function upateCustomerDetails() {
  var ufname = document.getElementById('ufname').value ;
  var ulname = document.getElementById('ulname').value ;
  var uaddress = document.getElementById('uaddress').value ;
  var ucontact =document.getElementById('ucontact').value ;
  var uimage = "";

  $.ajax({
    url: "php/customer.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "fname": ufname,
      "lname": ulname,
      "image": uimage,
      "contact": ucontact,
      "address": uaddress,
      "lat":"",
      "lng":"",
      "type":4
    },success: function(result){
      console.log(result);
    },error: function(response) {
      console.log(response);
    }
  });
}










var directionsDisplay,directionsService,map,infoWindow,geocoder,gmarker = [],currentadd;
// -------------------------------- MAPS API ------------------------------------------//
function initializeMap() {
  var marker;
  // directionsDisplay = new google.maps.DirectionsRenderer();
  // directionsService = new google.maps.DirectionsService();
  var map = new google.maps.Map(document.getElementById('customer_map'), {
    zoom: 10,
    center: new google.maps.LatLng(custlat, custlng),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  // directionsDisplay.setMap(map);
  infoWindow = new google.maps.InfoWindow();
  geocoder = new google.maps.Geocoder();

  // Try HTML5 geolocation.
  if (navigator.geolocation && isonEdit) {
    console.log("Geolocation is Enabled");
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Current Location.');
      infoWindow.open(map);
      map.setCenter(pos);

      // geocoder.geocode({'location': pos}, function(results, status) {
      //   if (status === 'OK') {
      //     if (results[0]) {
      //       map.setZoom(17);
      //       currentadd = results[0].formatted_address;
      //       infoWindow.setContent("Current Location: "+results[0].formatted_address);
      //       document.getElementById("uaddress").value = results[0].formatted_address;
      //       console.log(results[0].formatted_address);
      //       // infoWindow.open(map, marker);
      //     } else {
      //       window.alert('No results found');
      //     }
      //   } else {
      //     window.alert('Geocoder failed due to: ' + status);
      //   }
      // });
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    //Broswer is NOT on Edit MODE
    if(isonEdit){
      // Browser doesn't support Geolocation
      alert('Your browser doesn\'t support geolocation.');
      handleLocationError(false, infoWindow, map.getCenter());
    }
  }

  google.maps.event.addListener(map, 'click', function(event) {

      if(isonEdit){
        removeMarkers();
        map.setZoom(17);
        var marker = new google.maps.Marker({
          position: event.latLng,
          map: map
        });
        gmarker.push(marker);

        geocoder.geocode({'location': event.latLng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {

              infoWindow.setContent("New Address: "+results[0].formatted_address);
              document.getElementById("uaddress").value = results[0].formatted_address;
              console.log(results[0].formatted_address);
              infoWindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
  });
}

function removeMarkers(){
    for(i=0; i<gmarker.length; i++){
        gmarker[i].setMap(null);
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

function hide (elements) {
  elements = document.querySelectorAll(elements);
  elements = elements.length ? elements : [elements];
  for (var index = 0; index < elements.length; index++) {
    elements[index].style.display = 'none';
  }
}

function show (elements) {
  elements = document.querySelectorAll(elements);
  elements = elements.length ? elements : [elements];
  for (var index = 0; index < elements.length; index++) {
    elements[index].style.display = 'block';
  }
}
