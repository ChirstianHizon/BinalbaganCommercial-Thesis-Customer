$(document).ready(function(){
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
      "limit":10,
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
