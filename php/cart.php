<?php
include '..\library\config.php';
include '..\classes\class.cart.php';
include '..\classes\class.orders.php';
include '..\classes\class.products.php';
// $orders = new Orders();
$cart = new Cart();
$product = new Products();

$cart = new Cart();

$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
$prdid = (isset($_POST['prdid']) && $_POST['prdid'] != '') ? $_POST['prdid'] : '';
$qty = (isset($_POST['qty']) && $_POST['qty'] != '') ? $_POST['qty'] : '';
$access = (isset($_POST['access']) && $_POST['access'] != '') ? $_POST['access'] : '';
$type = (isset($_POST['type']) && $_POST['type'] != '') ? $_POST['type'] : '';


$custid = (!empty($_SESSION['custid'])) ? $_SESSION['custid'] : "";

$access_web = "bd31b73daa1b64f0f2f6044a4fe0bc98";
$access = md5($access);
if($access == $access_web){
  if($custid == ""){
    echo false;
  }else{

    switch ($type) {
      case 0:
        # code...
        break;
      case 1:

        break;
      case 2:
      $list =  $cart->addCart($prdid,$custid,$qty);
      if($list==1){break;}
      else{
        foreach($list as $value){
          $list = $cart->specsupdateCart($value['cart_id'],$value['cart_prd_qty'] + $qty,$value['prd_id'],$custid);
        }
      }
      echo $list;
        break;
      default:
        echo json_encode(array("main" => "TYPE ERROR"));
        break;
    }

  }



}else {
  echo json_encode(array("main" => $access));
}
