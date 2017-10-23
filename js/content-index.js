var modal;
$(function() {
    console.log('SCRIPT RUNNING');

    createPage();
    generateProductCategory();
});

function generateProductCategory() {
  var category = document.getElementById("category");
  category.innerHTML = "";
  $.ajax({
    url: "php/category.php",
    type: "POST",
    async: true,
    data: {
      "type": 6
    },
    success: function(result) {
      category.innerHTML = category.innerHTML = '<option value="ALL" selected>ALL</option>'+result;
    },
    error: function(response) {
      console.log(response);
    }
  });
}

function createPage(){
  $.ajax({
    url: "php/products.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "search":"",
      "limit":99,
      "lastprd":0,
      "type":1
    },success: function(result){
      // console.log(result);
      document.getElementById("prodview").innerHTML=result.main;
    },error: function(response) {
      console.log(response);
    }
  });
}

function searchPage(){
  var search = document.getElementById("searchbar").value;
  var category = document.getElementById("category").value;
  $.ajax({
    url: "php/products.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "category":category,
      "search":search,
      "limit":10,
      "lastprd":0,
      "type":1
    },success: function(result){
      console.log(result);
      // document.getElementById("prodview").innerHTML="";
      document.getElementById("prodview").innerHTML=result.main;
    },error: function(response) {
      console.log(response);
    }
  });
}

var itemselected = false;
function addtocart(clickedElement) {
  var id = clickedElement.id;
  var input = document.getElementById("val-"+id).value;
  var max = document.getElementById("val-"+id).max;


  if(itemselected){
    return false;
  }

  itemselected = true;

  if(parseInt(input) > parseInt(max)){
    alert("Exceeded Available Product");
    return false;
  }
  if(input <=0){
    document.getElementById("val-"+id).value = "1";
    alert("Input Value Error");
    return false;
  }

  metroDialog.create({
      title: "Do want to add this item to the Cart",
      content: "Add "+input+"pcs/s",
      actions: [
          {
              title: "Add to Cart",
              cls: "js-dialog-close",
              onclick: function(el){
                $.ajax({
                  url: "php/cart.php",
                  type: "POST",
                  async: true,
                  dataType:"json",
                  data: {
                    "access":access,
                    "prdid":id,
                    "qty":input,
                    "type":2
                  },success: function(result){
                     console.log(result);
                     itemselected = false;
                     if(!result.main){
                       alert("Please Login to Use Services");
                     }else{
                       alert("Product Added to Cart");
                       cartitemcount();
                       createPage();
                       notifyAddCart();
                       location.reload(); 
                     }
                  },error: function(response) {
                    console.log(response);
                  }
                });
              }
          },
          {
              title: "Cancel",
              cls: "js-dialog-close",
              onclick: function(el){
                itemselected = false;
              }
          }
      ],
      options: {


      }
  });
}


function notifyAddCart() {
  $.Notify({
      caption: 'Notify title',
      content: 'Product Added to cart',
      icon: "<span class='mif-vpn-publ'></span>"
  });
}
