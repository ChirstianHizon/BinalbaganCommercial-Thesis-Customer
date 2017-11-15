<?php
  if (session_status() === PHP_SESSION_NONE){session_start();}
  // session_start();
  $module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
  $stat = (isset($_GET['stat']) && $_GET['stat'] != '') ? $_GET['stat'] : '';
  if($module == 'logout'){

    // $_SESSION = [];
    $_SESSION['custlogin']= false;
    $_SESSION['custid'] = '';
    $_SESSION['custname'] = '';
    // session_destroy();
    header("location: index.php".$stat);
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <style>
  body{
    display: none;
  }
  </style>
  <script>
    var access = "Binalbagan_Commercial_WEB_Access";
  </script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Binalbagan Commercial</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <link href="api/MetroUI/css/metro.css" rel="stylesheet">
  <link href="api/MetroUI/css/metro-colors.css" rel="stylesheet">
  <link href="api/MetroUI/css/metro-responsive.css" rel="stylesheet">
  <link href="api/MetroUI/css/metro-icons.css" rel="stylesheet">

  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="api/MetroUI/js/metro.js"></script>



  <?php
    switch ($module) {
      case '':
        echo '<link href="css/custom-home.css" rel="stylesheet">';
        echo '<link href="css/home-index.css" rel="stylesheet">';
        break;
      case 'products':
        echo '<link href="css/custom-content.css" rel="stylesheet">';
        break;
      case 'account':
        echo '<link href="css/custom-content.css" rel="stylesheet">';
        break;
    }
   ?>
   <link href="css/index.css" rel="stylesheet">
</head>

<body id="body">

  <?php
    switch ($module) {
      case '':
        require_once 'home/index.php';
        break;
      case 'products':
        require_once 'content/index.php';
        break;
      case 'account':
        require_once 'content/index.php';
        break;
    }
   ?>
   <!-- <link rel="stylesheet" type="text/css" href="api/DataTables/datatables.min.css"/> -->

   <link href="css/login.css" rel="stylesheet">

   <div id="login-modal" class="modal">
     <!-- Modal content -->
     <?php
    //  $fname = (!empty($_SESSION['custfname'])) ? $_SESSION['custfname'] : "";
    //   echo '<script> alert("'.$fname.'"); </script>'
      ?>

     <div class="modal-content">
       <span onclick="closeModal()" class="close">&times;</span>
       <div class="modal-header">

         <h2>Login</h2>
       </div>
       <div class="modal-body">
         <form id="login-form" onsubmit="return login();">
             <div class="input-control text" data-role="input">
               <input type="text" name="fname" id="log_uname" placeholder="Username" minlength="7" maxlength="20" required/>
             </div>
             <br/>
             <div class="input-control password" data-role="input">
               <input type="password" name="pass" id="log_upass" placeholder="Password" minlength="7" maxlength="20" required/>
               <button class="button helper-button reveal"><span class="mif-looks"></span></button>
             </div>
             <br/>
             <br/>
             <button id="submit" class="button">Login</button>
         </form>
         <br/>
         <h5>Don't Have an Account? <a href="#" onclick="return openRegister()">Sign up</a></h5>
         <h5><a href="/console" >Employee Login</a></h5>
       </div>
     </div>
   </div>

   <div id="register-modal" class="modal">
     <!-- Modal content -->
     <div class="modal-content">
       <span onclick="closeModal()" class="close">&times;</span>
       <div class="modal-header">

         <h2>Sign up</h2>
       </div>
       <div class="modal-body">
         <b id="reg-status"></b>
         <form id="register-form" onsubmit="return register();">
             Username:
             <div class="input-control text" data-role="input">
               <input type="text" name="uname" id="uname" placeholder="Username" minlength="7" pattern="[a-zA-Z0-9\s]+" title=" must be contain both Number and Letters" maxlength="18" required/>
               <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
             Password:
             <div class="input-control password" data-role="input">
               <input type="password" name="upass" pattern="[a-zA-Z0-9\s]+" id="upass" placeholder="Password" minlength="7"  title=" must be contain both Number and Letters" maxlength="20" required/>
               <button class="button helper-button reveal"><span class="mif-looks"></span></button>
             </div>


             Re-enter Password:
             <div class="input-control password" data-role="input">
               <input type="password" name="repass" pattern="[a-zA-Z0-9\s]+" id="repass" placeholder="Re enter Password" minlength="7" title=" must be contain both Number and Letters" maxlength="20" required/>
               <button class="button helper-button reveal"><span class="mif-looks"></span></button>
             </div>

             First Name:
            <div class="input-control text" data-role="input">
              <input type="text" name="fname" id="fname" placeholder="First Name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title=" must be contain letters ONLY" minlength="2" maxlength="20" required/>
              <button class="button helper-button clear"><span class="mif-cross"></span></button>
           </div>


             Last Name:
             <div class="input-control text" data-role="input">
               <input type="text" id="lname" placeholder="Last Name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title=" must be contain letters ONLY" minlength="2" maxlength="20" required/>
               <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>


             Mobile Number:
          <div class="input-control text" data-role="input">
             <input type="text" id="contact" placeholder="must start with 09" maxlength="11" minlength="11" min="1" max="99999999999" title="must start with 09"pattern="^(09|\+639)\d{9}$" required/>
             <button class="button helper-button clear"><span class="mif-cross"></span></button>
          </div>

          <div id="customer_map" class="map"></div>
          <br  />

          Address:</br>
          <div class="input-control textarea"
              data-role="input" data-text-auto-resize="true" data-text-max-height="200" placeholder="Address" >
              <textarea id="xaddress" minlength="7" placeholder="Place your Delivery Address..." pattern="[a-zA-Z0-9\s]+" title=" must be contain both Number and Letters" required></textarea>
          </div>

             </br>
             <input id="submit" type="submit" value="Register"/>
         </form>
         <br/>
       </div>
     </div>
   </div>


   <div id="cart-modal" class="modal">
     <!-- Modal content -->
     <div class="modal-content">
       <span onclick="closeModal()" class="close">&times;</span>
       <div class="modal-header">

         <h2>My Cart</h2>
       </div>
       <div class="modal-body">
         <b id="cart-status"></b>
         <table id="cart_id" class="table cell-hovered border bordered" width="100%" cellspacing="0">
           <thead>
               <tr>
                   <th>Product</th>
                   <th>Quantity</th>
                   <th>Subtotal</th>
                   <th style="width:50px;"></th>
               </tr>
           </thead>
           <tbody id="cart-body">
           </tbody>
         </table>
         <br/>
         <br/>
         <br/>
         <br/>
         Cart Total Amount: P<b id="cart-total"></b>
         <br/>
       </div>
       <div class = "modal-footer">
         <button id="checkout" onclick="openTypePicker()" class="button success"> Checkout </button>
       </div>
     </div>
   </div>

   <div id="type-modal" class="modal">
     <!-- Modal content -->
     <div class="modal-content">
       <span onclick="closeModal()" class="close">&times;</span>
       <div class="modal-header">

         <h2>My Cart</h2>
       </div>
       <div class="modal-body">
         Choose how to recieve Product:
         <br/>
        <button id="btndelivery" class="btntype" onclick="typeChoose(this)"> Delivery </button>

        <button class="btntype" onclick="typeChoose(this)" id="0" class="button danger"> Pickup </button>
       </div>
     </div>
   </div>


   <script src="js/index.js"></script>
   <script type="text/javascript" src="api/DataTables/datatables.min.js"></script>
   <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5_KfF9P5eQzcC_fO4VWdgoumYFv7vAQg&callback=initializeMap"async defer></script> -->
</body>

</html>
