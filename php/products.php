<?php
include '../library/config.php';
include '../classes/class.products.php';

$products = new Products();

$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
$type = (isset($_POST['type']) && $_POST['type'] != '') ? $_POST['type'] : '';
$access = (isset($_POST['access']) && $_POST['access'] != '') ? $_POST['access'] : '';

$search = (isset($_POST['search']) && $_POST['search'] != '') ? $_POST['search'] : '';
$limit = (isset($_POST['limit']) && $_POST['limit'] != '') ? $_POST['limit'] : '';
$lastprd = (isset($_POST['lastprd']) && $_POST['lastprd'] != '') ? $_POST['lastprd'] : '';

$search =$products->str_insert($search, "'", "'");



$access_web = "bd31b73daa1b64f0f2f6044a4fe0bc98";
$access = md5($access);
if($access == $access_web){
  switch ($type) {
    case 0:
    echo json_encode(array("main" => "PHP RUNNING"));
    break;
    case 1:
    $html = "";
    $list = $products->createPage((int)$limit,(int)$lastprd,$search);
    if(!$list){
      echo json_encode(array("main" => '<div id="noprod-container"><b id="noprod">NO PRODUCTS FOUND</b></div>',"COUNT"=>0));
      break;
    }
    foreach($list as $value){
      $desc = strlen($value['PDESC']) > 150 ? substr($value['PDESC'],0,150)."..." : $value['PDESC'];

      $name = strlen($value['NAME']) > 45 ? substr($value['NAME'],0,45)."..." : $value['NAME'];
      if($value['LMAX'] > 0){
      $html = $html.'

        <div class="col-sm-6 col-md-3">
          <div class="thumbnail featured-product">
            <a href="#">
            <br/>
              <img src="'.$value['IMAGE'].'" id="product-image" alt="">
            </a>
            <div class="caption">
              <div  class="prod-view-title">
              <h3>'.$name.'</h3>
              </div>
              <div  class="prod-view-desc">
              <p>'.$desc.'</p>
              </div>
              <p class="price">₱ '.number_format($value['PRICE'],2).'</p>
              <p class="quantity">Available:  <b>'.number_format($value['LMAX'],0).'</b></p>

              <!-- Input Group -->
              <div class="input-group">
                <input min="1" id="val-'.$value['ID'].'" max="'.$value['LMAX'].'" type="number" class="form-control" value="1" required>
                <span class="input-group-btn">
                  <button id="'.$value['ID'].'" onclick="addtocart(this)"class="btn btn-primary" type="button">
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                    Add to Cart
                  </button>
                </span>
              </div>

            </div>
          </div>
        </div>

        ';
      }else{
        $html = $html.'

          <div class="col-sm-6 col-md-3">
            <div class="thumbnail featured-product">
              <a href="#">
              <br/>
                <img src="'.$value['IMAGE'].'" id="product-image" alt="">
              </a>
              <div class="caption">
                <div  class="prod-view-title">
                <h3>'.$value['NAME'].'</h3>
                </div>
                <div  class="prod-view-desc">
                <p>'.$desc.'</p>
                </div>
                <p class="price">₱ '.number_format($value['PRICE'],2).'</p>
                <p class="quantity" style="color:red;"><b>Not Available</b></p>
              </div>
            </div>
          </div>

          ';
      }

    }
    echo json_encode(array("main" => $html,"COUNT"=>0));
    break;











    default:
    echo json_encode(array("main" => "type ERROR"));
    break;
  }
}else{
  header("location: ..\index.php");
}
