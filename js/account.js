var ordertb;
$(function() {
    console.log('SCRIPT RUNNING');

    ordertb = $('#order_id').DataTable({
      "responsive": true,
      "bLengthChange": false,
      "bInfo" : false,
      "bFilter": false,
      "pageLength": 10
    });

});


function getUserCart(){
  $.ajax({
    url: "php/orders.php",
    type: "POST",
    async: true,
    dataType: "json",
    data: {
      "access":access,
      "type":1
    },success: function(result){
      console.log(result);
      if(!result.cust){
        closeModal();
        alert("Login To View Items on Cart");
      }else{
        carttb.destroy();
        document.getElementById("cart-body").innerHTML=result.main;
        document.getElementById("cart-total").innerHTML=" "+result.total;
        carttb = $('#cart_id').DataTable({
          "responsive": true,
          "bLengthChange": false,
          "bInfo" : false,
          "bFilter": false,
          "bSort":false,
          "pageLength": 5
        });
        openModal();
      }
    },error: function(response) {
      console.log(response);
    }
  });
  return false;
}
