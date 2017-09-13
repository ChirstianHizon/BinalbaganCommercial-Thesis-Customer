<?php

  $module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
  body{
    display: none;
  }
  </style>
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
        break;
      case 'products':
        echo '<link href="css/custom-content.css" rel="stylesheet">';
        break;
    }
   ?>
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
    }
   ?>

   <script>
   $(document).ready(function(){
       console.log( "ready!" );
       document.getElementById("body").style.display = "block";
   });
   </script>
</body>

</html>
