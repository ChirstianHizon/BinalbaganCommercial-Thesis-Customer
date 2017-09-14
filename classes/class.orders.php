<?php
class Orders{
  public $db;
  public function __construct(){
    $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if(mysqli_connect_errno()){
      echo "Database connection error.";
      exit;
    }
  }

  public function test(){
    return "test OK";
  }

  public function addOrder($custid,$order){
    $sql = "INSERT INTO tbl_order(order_datestamp,order_timestamp,cust_id,order_type)
    VALUES(NOW(),NOW(),'$custid','$order')";

    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
    if($result == 1){
      //GETS THE LAST ID USED IN QUERY
      $result = mysqli_insert_id($this->db);
    }
    return $result;
  }

  public function addOrderList($orderid,$prdid,$prdqty){
    $sql = "INSERT INTO tbl_order_list(prd_id,prd_qty,order_id)
    VALUES('$prdid','$prdqty','$orderid')";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
    return $result;
  }









}
