<?php
class Cart{
public $db;
  public function __construct(){
    $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if(mysqli_connect_errno()){
      echo "Database connection error.";
      exit;
    }
  }

  public function test(){
    return "CLASS OK";
  }

  public function getCart($userid){
    $sql = "SELECT * FROM (tbl_cart INNER JOIN tbl_product ON tbl_cart.prd_id = tbl_product.prd_id) WHERE emp_id ='$userid'";
    $result = mysqli_query($this->db,$sql);
    if($result){
      while($row = mysqli_fetch_assoc($result)){
        $list[] = $row;
      }
      if(empty($list)){return false;}
      return $list;
    }else {
      return $result;
    }
  }

  public function getSpecificCart($id,$userid){
    $sql = "SELECT * FROM (tbl_cart INNER JOIN tbl_product ON tbl_cart.prd_id = tbl_product.prd_id) WHERE cart_id ='$id' limit 1";
    $result = mysqli_query($this->db,$sql);
    if($result){
      while($row = mysqli_fetch_assoc($result)){
        $list[] = $row;
      }
      if(empty($list)){return false;}
      return $list;
    }else {
      return $result;
    }
  }

  public function getSpecificUserCart($prdid,$userid){
    $sql = "SELECT * FROM tbl_cart WHERE prd_id ='$prdid' AND emp_id='$userid' limit 1";
    $result = mysqli_query($this->db,$sql);
    if($result){
      while($row = mysqli_fetch_assoc($result)){
        $list[] = $row;
      }
      if(empty($list)){return false;}
      return $list;
    }else {
      return $result;
    }
  }

  public function specsupdateCart($id,$qty,$prdid,$userid){
    $sql = "UPDATE tbl_cart SET
    cart_prd_qty = '$qty'
    WHERE prd_id = '$prdid' AND cart_id = '$id' AND cust_id = '$userid'";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . "CLASS ERROR");
    if($result == true){$result = "UPDATE COMPLETE ";}
    return $result;
  }

  public function addCart($prdid,$userid,$qty){
    $sql = "SELECT * FROM tbl_cart WHERE prd_id = '$prdid' AND cust_id = '$userid' limit 1";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() ."SQL =".$sql);
    while($row = mysqli_fetch_assoc($result)){
      $list[] = $row;
    }
    if(empty($list)){
      $sql = "INSERT INTO tbl_cart(cust_id,prd_id,cart_prd_qty,cart_datestamp,cart_timestamp)
         VALUES('$userid','$prdid','$qty',NOW(),NOW())";
      // return $sql;
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() ."SQL =".$sql);
      if($result == true){$result = "INSERT COMPLETE";}
      return $result;
    }else {
      return $list;
    }
  }

}
