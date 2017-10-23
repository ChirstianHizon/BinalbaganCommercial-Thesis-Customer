<?php
class Customer {
  public $db;
  public function __construct(){
    $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if(mysqli_connect_errno()){
      echo "Database connection error.";
      exit;
    }
  }

  public function createCustomerAccount($uname,$pass,$fname,$lname,$contact,$address){
    $pass = md5($pass);
    $sql = "INSERT INTO tbl_customer(cust_username,cust_password,cust_firstname,cust_lastname,cust_contact)
    VALUES('$uname','$pass','$fname','$lname','$contact')";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
    if($result == 1){
      //GETS THE LAST ID USED IN QUERY
      $result = mysqli_insert_id($this->db);

      $sql = "INSERT INTO tbl_address(add_name,cust_id)
      VALUES('$address','$result')";
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);

    }

    return $result;
  }

  public function checkUname($uname){
    $sql="SELECT COALESCE(COUNT(*),0) AS RESULT FROM tbl_customer WHERE cust_username = '$uname' limit 1";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
    $row = mysqli_fetch_assoc($result);
    $result = $row['RESULT'];
    if($result <= 0){
      return true;
    }else{
      return false;
    }
  }

  public function checkLogin($uname,$pass){
    $pass = md5($pass);
    $sql = "SELECT cust_id AS ID,cust_lastname AS LNAME,cust_firstname AS FNAME,cust_username AS USERNAME,count(cust_id) AS COUNT FROM tbl_customer
    WHERE cust_username = '$uname' AND cust_password = '$pass' ";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
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

  public function getCustomerDetails($id){
    $sql = " SELECT *
             FROM tbl_customer
             WHERE cust_id = '$id'
             LIMIT 1
    ";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
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

  public function getCustomerAddress($id){
    $sql = "SELECT *
            FROM tbl_address ad
            WHERE ad.cust_id = '$id'
    ";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
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

  public function getSpecCustomerAddress($id){
    $sql = "SELECT *
            FROM tbl_address ad
            WHERE ad.cust_id = '$id'
    ";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
    $row = mysqli_fetch_assoc($result);
    $result = $row['add_name'];

  }

  public function updateCustomerDetails($id,$fname,$lname,$contact,$image,$address){

    $sql = "UPDATE tbl_customer SET
    cust_firstname = '$fname',
    cust_lastname = '$lname',
    cust_contact = '$contact',
    cust_image = '$image'
    WHERE cust_id = '$id'";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);

    $sql = "SELECT COALESCE(add_id,0) AS ID
    FROM tbl_address
    WHERE cust_id = '$id' AND add_status = '1' limit 1";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);

    if(!mysqli_num_rows($result) > 0){

      $sql = "INSERT INTO tbl_address(add_name,cust_id)
      VALUES('$address','$id')";
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
      return "HAHA";


    }else{
      $row = mysqli_fetch_assoc($result);
      $addid = $row['ID'];

      $sql = "UPDATE tbl_address SET
      add_status = '0'
      WHERE add_id = '$addid'";
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);

      $sql = "INSERT INTO tbl_address(add_name,cust_id)
      VALUES('$address','$id')";
      $result = mysqli_query($this->db,$sql) or die(mysqli_error() . $sql);
      return $result;

    }

  }

  public function insertAddress($id,$address,$lat,$lng,$notes){
    $sql = "INSERT INTO tbl_address(add_name,add_notes,add_lat,add_lng,add_status)
    VALUES('$id','$notes','$lat','$lng','1')";
  }









  public function str_insert($str, $search, $insert) {
    $index = strpos($str, $search);
    if($index === false) {
        return $str;
    }
    return substr_replace($str, $search.$insert, $index, strlen($search));
  }

}
