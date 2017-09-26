var modal,carttb;
$(document).ready(function(){
  document.getElementById("body").style.display = "block";

  carttb = $('#cart_id').DataTable({
    "responsive": true,
    "bLengthChange": false,
    "bInfo" : false,
    "bFilter": false,
    "pageLength": 10
  });

});




var modalactive= false;
function openRegister(){
  if(modalactive == true){
    closeModal();
  }
  modalactive = true;
  document.getElementById("register-form").reset();
  modal = document.getElementById('register-modal');
  openModal();
  return false;
}
function openTypePicker(clickedElement){
  if(modalactive == true){
    closeModal();
  }
  modalactive = true;
  modal = document.getElementById('type-modal');
  openModal();
  return false;
}
var page;
function openLogin(pge){
  if(modalactive == true){
    closeModal();
  }
  modalactive = true;
  document.getElementById("login-form").reset();
  modal = document.getElementById('login-modal');
  openModal();
  return false;
}
function openMyCart(){
  if(modalactive == true){
    closeModal();
  }
  modalactive = true;
  modal = document.getElementById('cart-modal');
  getUserCart();
  return false;
}




function removecartitem(clickedElement) {
  var id = clickedElement.id;
  $.ajax({
    url: "php/cart.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "id":id,
      "type":4
    },success: function(result){
      console.log(result);
      if(result.main){
        alert("Product Removed From Cart");
        getUserCart();
      }
    },error: function(response) {
      console.log(response);
    }
  });

}

function typeChoose(clickedElement) {
  var type = clickedElement.id;
  if(type == "btndelivery"){
    type = 1;
  }
  Checkout(type);
}

// -------------------------------- FORMS -------------------------------------//
function login() {
  modalactive= true;
  var uname = document.getElementById("log_uname").value;
  var pass = document.getElementById("log_upass").value;
  $.ajax({
    url: "php/customer.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "uname":uname,
      "pass":pass,
      "type":2
    },success: function(result){
      console.log(result);
      if(result.status){
        closeModal();
        window.location = 'index.php'+page;
        // alert("Login Sucessfully");
      }else{
        alert("INCORRECT DATA");
      }
    },error: function(response) {
      console.log(response);
    }
  });
  return false;
}

function register() {
  modalactive= true;
  var uname = document.getElementById("uname").value;
  var pass = document.getElementById("upass").value;
  var repass =document.getElementById("repass").value;
  var fname = document.getElementById("fname").value;
  var lname =document.getElementById("lname").value;
  var contact =document.getElementById("contact").value;

  console.log(fname);
  if(repass != pass){
    document.getElementById("reg-status").innerHTML="";
    document.getElementById("reg-status").innerHTML= "Passwords Does not Match";
    return false;
  }
  $.ajax({
    url: "php/customer.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "uname":uname,
      "pass":pass,
      "fname":fname,
      "lname":lname,
      "contact":contact,
      "type":1
    },success: function(result){
      console.log(result);
      if(result.uname){
        if(result.main){
          closeModal();
          alert("Registered Sucessfully");
        }
      }else{
        alert("username already used");
      }

    },error: function(response) {
      console.log(response);
    }
  });
  return false;
}
var total=0;
function getUserCart(){
  $.ajax({
    url: "php/cart.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "type":1
    },success: function(result){
      console.log(result);
      if(!result.cust){
        closeModal();
        alert("Login To View Items on Cart");
      }else{
        carttb.destroy();
        total = result.total;
        if(total<5000){
          hide('#btndelivery');
        }else{
          show('#btndelivery');
        }
        document.getElementById("cart-body").innerHTML=result.main;
        document.getElementById("cart-total").innerHTML=" "+addCommas(get2decimal(result.total));
        carttb = $('#cart_id').DataTable({
          "responsive": true,
          "bLengthChange": false,
          "bInfo" : false,
          "bFilter": false,
          "pageLength": 5
        });
        openModal();
      }
    },error: function(response) {
      console.log(response);
    }
  });
  return false;
}


function Checkout(type){
  $.ajax({
    url: "php/cart.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "order":type,
      "type":3
    },success: function(result){
      console.log(result);
      if(result.main){
        closeModal();
        alert("Product Purchased");
      }
    },error: function(response) {
      console.log(response);
    }
  });
  return false;
}

























//------------------------------------- MODAL FUNCTIONS------------------------ //
function closeModal(){
  modal.style.display = "none";
  modalactive= false;
}
function openModal(){
  modal.style.display = "block";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        closeModal();
    }
}


    // ---------------------------------- UTILITIES --------------------------//
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
