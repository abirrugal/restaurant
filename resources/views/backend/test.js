starting();
   
function starting(){




$.ajax({
url: "{{asset('/')}}admin/order/starting_data",
dataType: 'json',
cache: false,
type: 'get',


success:function(value){

 if (value.total_payment !== null) {
          var total_paid = value.total_payment;

 }else{
    var total_paid = 0;
 }

 if (value.total_discount !== null) {
     
     var total_discount = value.total_discount;
 }else{
     var total_discount = 0;
 }

 if (value.percent_discount !== null && value.percent_discount !== undefined) {
     
     var percent_discount = '( ' +value.percent_discount + '% )';
 }else{
     var percent_discount = '( 0% )';
 }

//  $('#amount_with_dis').text();

var change = parseInt(total_paid) - parseInt(value.total_with_discount);


$('.grand_amount').val(value.total);
$('.discount_amount').val(total_discount);
$('.vat_amount').val(value.total_vat);

$('.payable_amount').val(value.total_with_discount);
$('#paid_amount').val(total_paid);
$('#change_amount').val(change);

$('#view_percent_discount').text(percent_discount);

 
},
error:function(data){
  console.log('error :'+data);
}
});



}