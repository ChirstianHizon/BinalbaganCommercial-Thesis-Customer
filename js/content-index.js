var modal;
$(function() {
    console.log('SCRIPT RUNNING');

    createPage();
});

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
  $.ajax({
    url: "php/products.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
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


function addtocart(clickedElement) {
  var id = clickedElement.id;
  var input = document.getElementById("val-"+id).value;
  var max = document.getElementById("val-"+id).max;
  if(input <=0){
    document.getElementById("val-"+id).value = "1";
    alert("Input Value Error");
    return false;
  }
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
       if(!result.main){
         alert("Please Login to Use Services");
       }else{
         alert("Product Added to Cart");
       }
    },error: function(response) {
      console.log(response);
    }
  });
}
