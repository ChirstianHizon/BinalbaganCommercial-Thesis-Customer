$(document).ready(function(){
    document.getElementById("body").style.display = "block";
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
      if(result.main){
        closeModal();
        alert("Registered Sucessfully");
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
