<?php
include '..\library\config.php';
include '..\classes\class.customer.php';

$customer = new Customer();


$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
$type = (isset($_POST['type']) && $_POST['type'] != '') ? $_POST['type'] : '';

$uname = (isset($_POST['uname']) && $_POST['uname'] != '') ? $_POST['uname'] : '';
$pass = (isset($_POST['pass']) && $_POST['pass'] != '') ? $_POST['pass'] : '';
$fname = (isset($_POST['fname']) && $_POST['fname'] != '') ? $_POST['fname'] : '';
$lname = (isset($_POST['lname']) && $_POST['lname'] != '') ? $_POST['lname'] : '';
$contact = (isset($_POST['contact']) && $_POST['contact'] != '') ? $_POST['contact'] : '';
$image = (isset($_POST['image']) && $_POST['image'] != '') ? $_POST['image'] : '';
$access = (isset($_POST['access']) && $_POST['access'] != '') ? $_POST['access'] : '';

$access_web = "bd31b73daa1b64f0f2f6044a4fe0bc98";
$access = md5($access);
if($access == $access_web){
  switch ($type) {
    case 0 :

    break;
    case 1:
    $result = $customer->createCustomerAccount($uname,$pass,$fname,$lname,$contact);
    echo json_encode(array("main" => $result));
    break;
    case 2:
    $login_status = $customer->checkLogin($uname,$pass);
    foreach($login_status as $value){
      if($value['COUNT']){
        // session_start();
        $_SESSION['login']= true;
        $_SESSION['userid']= $value['ID'];
        $_SESSION['username']= $value['USERNAME'];
        $_SESSION['userfname']=$value['FNAME'];
        $_SESSION['userlname']= $value['LNAME'];
        echo json_encode(array("main" => "OK","status" =>  $_SESSION['login'],$_SESSION['userfname']));
      }else{
        echo json_encode(array("main" => "OK","status" => false));
      }

    }
    break;
    default:
    echo json_encode(array("main" => "TEST"));
    break;
  }
}else{
  header("location: ../index.php");
}
