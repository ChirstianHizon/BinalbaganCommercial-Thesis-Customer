<?php
include '../library/config.php';
include '../classes/class.cart.php';
include '../classes/class.orders.php';
include '../classes/class.products.php';

$order = new Orders();


$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
$access = (isset($_POST['access']) && $_POST['access'] != '') ? $_POST['access'] : '';
$type = (isset($_POST['type']) && $_POST['type'] != '') ? $_POST['type'] : '';

$custid = (!empty($_SESSION['custid'])) ? $_SESSION['custid'] : "";

$access_web = "bd31b73daa1b64f0f2f6044a4fe0bc98";
$access = md5($access);



// $id =$order->str_insert($id, "'", "'");

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
      $note="";
      $list = $order->getOrderList($custid);
      if(!$list){echo json_encode(array("main" => "","total"=> 0,"cust"=>true));break;}
      foreach($list as $value){
      $count++;
      $total = $total += $value['TOTAL'];

      switch ($value['OSTAT']) {
        case 0:
        $stat = '<span style="color:orange"><b>Pending</b></span>';
          break;
        case 1:
          $stat = '<span style="color:green"><b>Approved</b></span>';
          break;
        case 2:
          $stat= '<span style="color:red"><b>Declined</b></span>';
          break;
        case 100:
          $stat = '<span style="color:black"><b>Completed</b></span>';
          break;
      }

      switch ($value['OTYPE']) {
        case 0:
        $otype = '<span style="color:green"><b>Pickup</b></span>';
          break;
        case 1:
        $otype = '<span style="color:black"><b>Delivery</b></span>';
          break;
      }
      $html = $html.'<tr>'.
                // '<td>'.$value['ID'].'</td>'.
                '<td>'.$value['ODATE'].'</td>'.
                '<td>'.number_format($value['QTY'],0).' item/s</td>'.
                '<td>P '.number_format($value['TOTAL'],2).'</td>'.
                '<td>'.$stat.'</td>'.
                '<td>'.$otype.'</td>'.
                '<td><button id="'.$value['ID'].'" onclick="return vieworder(this)" class="button small-button"> View</button></td>'.
            "</tr>";
      $note = $value['NOTE'];
      }
      echo json_encode(array("main" => $html,"count"=> number_format($count,0),"total"=>$total,"cust"=>true,"note"=>$note));
      break;


      case 2:
      $html="";
      $count=0;
      $total=0;
      $message = "";
      $stat = "";
      $address = "";
      $list = $order->getSpecOrder($id);
      if(!$list){echo json_encode(array("main" => "","total"=> 0,"cust"=>true));break;}
      foreach($list as $value){
        $address = $value['ADDRESS'];
        $message = $value['NOTE'];
        $total += $value['SUBTOTAL'];
        $html = $html.'<tr>'.
                  '<td>'.$value['NAME'].'</td>'.
                  '<td>'.number_format($value['QTY'],0).' item/s</td>'.
                  '<td>P '.number_format($value['SUBTOTAL'],2).'</td>'.
              "</tr>";

        switch ($value['STATUS']) {
          case 0:
          $stat = '<span style="color:orange">PENDING</span>';
            break;
          case 1:
            $stat = '<span style="color:green">APPROVED</span>';
            break;
          case 2:
            $stat= '<span style="color:red">DECLINED</span>';
            break;
          case 100:
            $stat = '<span style="color:black">COMPLETED</span';
            break;
        }

      }
      echo json_encode(array("main" => $html,"address"=>$address,"message"=>$message,"total"=>number_format($total,2),"status"=>$stat));
      break;
    default:
      echo json_encode(array("main" => "TYPE ERROR"));
      break;
  }

}else {
  header("location: ..\index.php");
}
