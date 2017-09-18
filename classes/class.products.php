<?php
class Products {
  public $db;
  public function __construct(){
    $this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if(mysqli_connect_errno()){
      echo "Database connection error.";
      exit;
    }
  }

  public function createPage($row,$lastprd,$search){
    if($search == ""){
      $sql =
      "SELECT *
        FROM(
          SELECT
          (@row_number:=@row_number + 1) AS ROW_NUM,
          prd_id AS ID,
          prd_name AS NAME,
          prd_desc AS PDESC,
          prd_level AS LMAX,
          prd_price AS PRICE,
          prd_image AS IMAGE,
          cat_name AS CATEGORY
          FROM tbl_product
          INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id
          INNER JOIN (SELECT @row_number := 0 AS row_number)rnum
        )tb_page
      ORDER BY ROW_NUM
      LIMIT $row OFFSET $lastprd";
    }else{
      $sql =
      "SELECT *
        FROM(
          SELECT
          (@row_number:=@row_number + 1) AS ROW_NUM,
          prd_id AS ID,
          prd_name AS NAME,
          prd_desc AS PDESC,
          prd_level AS LMAX,
          prd_price AS PRICE,
          prd_image AS IMAGE,
          cat_name AS CATEGORY
          FROM tbl_product
          INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id
          INNER JOIN (SELECT @row_number := 0 AS row_number)rnum
          WHERE prd_name LIKE CONCAT('%','$search' ,'%')
        )tb_page
      ORDER BY ROW_NUM
      LIMIT $row OFFSET $lastprd";
    }
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
