<?php
include '..\library\config.php';
include '..\classes\class.cart.php';
include '..\classes\class.orders.php';
include '..\classes\class.products.php';
// $orders = new Orders();
$cart = new Cart();
$product = new Products();

$order = new Orders();

$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
$prdid = (isset($_POST['prdid']) && $_POST['prdid'] != '') ? $_POST['prdid'] : '';
$qty = (isset($_POST['qty']) && $_POST['qty'] != '') ? $_POST['qty'] : '';
$access = (isset($_POST['access']) && $_POST['access'] != '') ? $_POST['access'] : '';
$ordertype = (isset($_POST['order']) && $_POST['order'] != '') ? $_POST['order'] : '';
$type = (isset($_POST['type']) && $_POST['type'] != '') ? $_POST['type'] : '';


$custid = (!empty($_SESSION['custid'])) ? $_SESSION['custid'] : "";

$access_web = "bd31b73daa1b64f0f2f6044a4fe0bc98";
$access = md5($access);
if($access == $access_web){
  if($custid == ""){
    echo json_encode(array("cust" => false,"custid" => $custid));
  }else{

    switch ($type) {
      case 0:
        # code...
        break;
      case 1:
      $html="";
      $count=0;
      $total = 0;
      $list =  $cart->getCustomerCart($custid);
      if(!$list){echo json_encode(array("main" => "","total"=> 0,"cust"=>true));break;}
      foreach($list as $value){
      $count++;
      $total = $total += $value['SUBTOTAL'];
      $html = $html.'<tr id="'.$value['ID'].'">'.
                '<td id="row_1">'.$value['NAME'].'</td>'.
                '<td>'.$value['QTY'].'</td>'.
                '<td>'.$value['SUBTOTAL'].'</td>'.
                '<td><button id="'.$value['ID'].'" onclick="return removecartitem(this)"> Remove</button></td>'.
            "</tr>";
      }
      echo json_encode(array("main" => $html,"count"=> $count,"total"=>$total,"cust"=>true));
      break;
        break;
      case 2:
      $list =  $cart->addCart($prdid,$custid,$qty);
      if($list==1){break;}
      else{
        if(is_array($list)){
          foreach($list as $value){
            $list = $cart->specsupdateCart($value['cart_id'],$value['cart_prd_qty'] + $qty,$value['prd_id'],$custid);
          }
        }
      }
      echo json_encode(array("main" => $list,"cust"=>true));
        break;
        case 3:
        // echo json_encode(array("main" => $order->addOrder($custid,$ordertype)));
        $list =  $cart->getCart($custid);
        if(!$list){break;}
        $orderid =  $order->addOrder($custid,$ordertype);
        $count = 0;
        foreach($list as $value){
          $order->addOrderList($orderid,$value['prd_id'],$value['cart_prd_qty']);
          $count++;
        }
        $stat = $cart->deleteALLCart($custid);
        echo json_encode(array("main" => true,"cust"=>$custid));
        break;
        case 4:
          $result = $cart->deleteCart($id,$custid);
          echo json_encode(array("main" => $result,"cust"=>$custid));
        break;




      default:
        echo json_encode(array("main" => "TYPE ERROR"));
        break;
    }

  }



}else {
  echo json_encode(array("main" => $access));
}
