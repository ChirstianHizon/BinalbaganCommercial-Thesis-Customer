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
$address = (isset($_POST['address']) && $_POST['address'] != '') ? $_POST['address'] : '';

$notes = (isset($_POST['notes']) && $_POST['notes'] != '') ? $_POST['notes   '] : '';


$lat = (isset($_POST['lat']) && $_POST['lat'] != '') ? $_POST['lat'] : '';
$lng = (isset($_POST['lng']) && $_POST['lng'] != '') ? $_POST['lng'] : '';


$access = (isset($_POST['access']) && $_POST['access'] != '') ? $_POST['access'] : '';

$access_web = "bd31b73daa1b64f0f2f6044a4fe0bc98";
$access = md5($access);



$uname = $customer->str_insert($uname, "'", "'");
$pass = $customer->str_insert($pass, "'", "'");
$fname = $customer->str_insert($fname, "'", "'");
$address = $customer->str_insert($address, "'", "'");
$lname = $customer->str_insert($lname, "'", "'");
$contact =$customer->str_insert($contact, "'", "'");
$image = $customer->str_insert($image, "'", "'");

$lat = $customer->str_insert($lat, "'", "'");
$lng = $customer->str_insert($lng, "'", "'");



if($access == $access_web){
  switch ($type) {
    case 0 :
    echo json_encode(array("main" => $result));
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
        $_SESSION['custlogin']= true;
        $_SESSION['custid']= $value['ID'];
        $_SESSION['custname']= $value['USERNAME'];
        $_SESSION['custfname']=$value['FNAME'];
        $_SESSION['custlname']= $value['LNAME'];
        echo json_encode(array("main" => "OK","status" =>  $_SESSION['custlogin'],$_SESSION['custfname']));
      }else{
        echo json_encode(array("main" => "OK","status" => false));
      }

    }
    break;
    case 3:
    $details = $customer->getCustomerDetails($_SESSION['custid']);
    $add_list = $customer->getCustomerAddress($_SESSION['custid']);
    if(!$details){
      echo json_encode(array("main" => "NO DETAILS FOUND"));
      break;
    }else{
      foreach($details as $value){
        $name =  $value['cust_username'];
        $fname =  $value['cust_firstname'];
        $lname =  $value['cust_lastname'];
        $contact = $value['cust_contact'];
        $image= $value['cust_image'];

      }
    }
    if(!$add_list){
      $address = "";
      $lat = "";
      $lng = "";
      $notes ="";
      break;
    }else{
      foreach($add_list as $value){
        $address = $value['add_name'];
        $lat = $value['add_lat'];
        $lng = $value['add_lng'];
        $notes =$value['add_notes'];
      }
    }

    echo json_encode(array(
    "main" => "OK",
    "name" => $name,
    "fname" => $fname,
    "lname" => $lname,
    "contact" => $contact,
    "image"=>$image,
    "address" => $address,
    "lat" => $lat,
    "lng" => $lng,
    "notes" =>$notes
    ));
    break;
    default:
    case 4:
    $status = $customer->updateCustomerDetails($_SESSION['custid'],$fname,$lname,$contact,$image);

    echo json_encode(array(
    "main" => $status,
    "fname" => $fname,
    "lname" => $lname,
    "contact" => $contact,
    "image"=>$image,
    "address" => $address,
    "lat" => $lat,
    "lng" => $lng,
    "notes" =>$notes
    ));
    break;
  }
}else{
  header("location: ../index.php");
}
