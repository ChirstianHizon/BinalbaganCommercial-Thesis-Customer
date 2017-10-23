<?php
class Category{
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

  public function addCategory($name,$desc){
    $name = mysqli_real_escape_string($this->db,$name);
    $desc = mysqli_real_escape_string($this->db,$desc);

    $sql = "INSERT INTO tbl_category(cat_name,cat_desc,cat_datestamp,cat_timestamp)
       VALUES('$name','$desc',NOW(),NOW())";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . "CLASS ERROR");
    return $result;
  }

  public function updateCategory($id,$name,$desc){
    $name = mysqli_real_escape_string($this->db,$name);
    $desc = mysqli_real_escape_string($this->db,$desc);

    $sql = "UPDATE tbl_category SET
    cat_name = '$name',
    cat_desc = '$desc'
    WHERE cat_id = '$id'";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . "CLASS ERROR");
    return $result;
  }
  public function deleteCategory($id){
    $sql = "UPDATE tbl_category SET
    cat_status = '0'
    WHERE cat_id = '$id'";
    $result = mysqli_query($this->db,$sql) or die(mysqli_error() . "CLASS ERROR");
    return $result;
  }

  public function getCategory(){
    $sql = "SELECT * FROM tbl_category WHERE cat_status = '1' ";
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

  public function getName($id){
    $sql = "SELECT cat_name FROM tbl_category WHERE cat_id= '$id'";
    $result = mysqli_query($this->db,$sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row['cat_name'];
    return $level;
  }

  public function getSpecificCategory($id){
    $sql = "SELECT * FROM tbl_category WHERE cat_id = '$id'";
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
}
