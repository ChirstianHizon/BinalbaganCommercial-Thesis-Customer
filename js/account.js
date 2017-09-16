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

    getUserOrders();

});


function getUserOrders(){
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
      ordertb.destroy();
      document.getElementById("order-body").innerHTML=result.main;
      document.getElementById("order-total").innerHTML=" P "+addCommas(get2decimal(result.total));
      ordertb = $('#order_id').DataTable({
        "responsive": true,
        "bLengthChange": false,
        "bInfo" : false,
        "bFilter": false,
        "bSort":false,
        "pageLength": 5
      });
    },error: function(response) {
      console.log(response);
    }
  });
  return false;
}








//---------------------------------------- UTILITIES --------------------------------//
function addCommas(nStr) {
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}
function get2decimal(int){
  return parseFloat(Math.round(int * 100) / 100).toFixed(2);
}
