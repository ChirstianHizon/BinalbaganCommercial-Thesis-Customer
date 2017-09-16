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
      $html="";
      $count=0;
      $total=0;
      $list = $order->getOrderList($custid);
      if(!$list){echo json_encode(array("main" => "","total"=> 0,"cust"=>true));break;}
      foreach($list as $value){
      $count++;
      $total = $total += $value['TOTAL'];

      switch ($value['OSTAT']) {
        case 0:
        $stat = "Pending";
          break;
        case 1:
          $stat = "Approved";
          break;
        case 2:
          $stat="Declined";
          break;
        case 100:
          $stat = "Completed";
          break;
      }

      switch ($value['OTYPE']) {
        case 0:
        $otype = "Pickup";
          break;
        case 1:
        $otype = "Delivery";
          break;
      }
      $html = $html.'<tr>'.
                '<td>'.$value['ID'].'</td>'.
                '<td>'.$value['ODATE'].'</td>'.
                '<td>'.$value['QTY'].'</td>'.
                '<td>P '.number_format($value['TOTAL'],2).'</td>'.
                '<td>'.$stat.'</td>'.
                '<td>'.$otype.'</td>'.
                '<td><button id="'.$value['ID'].'" onclick="return vieworder(this)"> View</button></td>'.
            "</tr>";
      }
      echo json_encode(array("main" => $html,"count"=> $count,"total"=>$total,"cust"=>true));
      break;
    default:
      echo json_encode(array("main" => "TYPE ERROR"));
      break;
  }

}else {
  header("location: ../index.php");
}
