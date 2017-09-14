<?php
include '..\library\config.php';
include '..\classes\class.cart.php';
include '..\classes\class.orders.php';
include '..\classes\class.products.php';

$order = new Orders();


$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
$access = (isset($_POST['access']) && $_POST['access'] != '') ? $_POST['access'] : '';
$type = (isset($_POST['type']) && $_POST['type'] != '') ? $_POST['type'] : '';

$custid = (!empty($_SESSION['custid'])) ? $_SESSION['custid'] : "";

$access_web = "bd31b73daa1b64f0f2f6044a4fe0bc98";
$access = md5($access);
if($access == $access_web){
  if($custid == ""){
  }

  switch ($type) {
    case 0:
      # code...
      break;
    case 1:

      break;
    default:
      echo json_encode(array("main" => "TYPE ERROR"));
      break;
  }

}else {
  header("location: ../index.php");
}
