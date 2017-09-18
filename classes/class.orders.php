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

  public function getOrderList($custid) {
    $sql = "SELECT
    tbl_order.order_id AS ID,
    prd_qty AS QTY,
    SUM(prd_price *prd_qty)AS TOTAL,
    order_status AS OSTAT,
    order_type AS OTYPE,
    order_datestamp AS ODATE
    FROM tbl_order
    INNER JOIN tbl_order_list ON tbl_order.order_id = tbl_order_list.order_id
    INNER JOIN tbl_product ON tbl_product.prd_id = tbl_order_list.prd_id
    WHERE cust_id = '$custid'
    GROUP BY tbl_order.order_id
    ORDER BY tbl_order.order_id DESC
    ";

    $result = mysqli_query($this->db,$sql);
    if($result){
      while($row = mysqli_fetch_assoc($result)){
        $list[] = $row;
      }
      if(empty($list)){return false;}
      return $list;
    }else {
      return $sql;
    }
  }



  public function str_insert($str, $search, $insert) {
    $index = strpos($str, $search);
    if($index === false) {
        return $str;
    }
    return substr_replace($str, $search.$insert, $index, strlen($search));
  }









}
