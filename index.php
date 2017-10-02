<?php

  $module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
  $stat = (isset($_GET['stat']) && $_GET['stat'] != '') ? $_GET['stat'] : '';
  if($module == 'logout'){
    session_start();
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
        require_once '.home/index.php';
        break;
      case 'products':
        require_once '.content/index.php';
        break;
      case 'account':
        require_once '.content/index.php';
        break;
    }
   ?>
   <link rel="stylesheet" type="text/css" href="api/DataTables/datatables.min.css"/>

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
             Username:
             <input type="text" name="fname" id="log_uname" placeholder="Username" required/>
             <br/>
             Password:
             <input type="password" name="pass" id="log_upass" placeholder="Password" required/>
             <br/>
             <br/>

             <input id="submit" type="submit" value="Login"/>
         </form>
         <br/>
         Don't Have an Account? <a href="#" onclick="return openRegister()">Sign up</a><br />
         Employee Login? <a href="/BinalbaganCommercial-Console/" >Login Here</a>
         <br/>
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
             <input type="text" name="uname" id="uname" placeholder="Username" required/>
             Password:
             <input type="password" name="upass" id="upass" placeholder="Password" required/>
             Re-enter Password:
             <input type="password" name="repass" id="repass" placeholder="Re enter Password" required/>

             First Name:
             <input type="text" name="fname" id="fname" placeholder="First Name" required/>
             Last Name:
             <input type="text" name="lname" id="lname" placeholder="Last Name" required/>
             Contact Number:
             <input type="number" name="c" id="contact" placeholder="Contact Number" required/>
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
         <table id="cart_id" class="display" width="100%" cellspacing="0">
           <thead>
               <tr>
                   <th>Product</th>
                   <th>Quantity</th>
                   <th>Subtotal</th>
                   <th></th>
               </tr>
           </thead>
           <tbody id="cart-body">
           </tbody>
         </table>
         <br/>
         <br/>
         Cart Total Amount: P<b id="cart-total"></b>
         <br/>
       </div>
       <div class = "modal-footer">
         <button id="checkout"onclick="openTypePicker()"> Checkout </button>
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

        <button class="btntype" onclick="typeChoose(this)" id="0"> Pickup </button>
       </div>
     </div>
   </div>


   <script src="js/index.js"></script>
   <script type="text/javascript" src="api/DataTables/datatables.min.js"></script>
</body>

</html>
