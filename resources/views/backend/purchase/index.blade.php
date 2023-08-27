
@extends('backend.layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 506px;"> 
    <section class="content-header">

 {{--  {{ session()->forget('purchase_id') }}  --}}




        <code>
                <span class="glyphicon glyphicon-cog" style="color: #3C8DBC"></span>
                                            <span style="color:#3C8DBC">Purchase Form</span>
                                </code> 
    </section> 
    <section class="content container-fluid"> 




<div class="row">

<div class="col-sm-6" style=" padding-right: 8px !important; padding-left: 8px !important; "> 


  <div class="d-flex">
        @php
            $id = session('purchase_id');
        @endphp

@if(session('purchase_id') !== null)

<form class="me-2 w-100 d-block" action="{{ route('admin.purchase.confirm_purchase', session('purchase_id')) }}" method="GET">

        <input type="hidden" name="paid" id="paid">
        <button class="btn btn-success  me-2 my-2 w-100 " id="confirm_purchase_id" onclick="confirm_purchase()">  Confirm purchase </button>

</form>
@endif
        @if(session('purchase_id') !== null)
        <button class="btn btn-danger my-2  w-100 " id="cancel_purchase_id" onclick="return cancel_purchase();">Cancel purchase</button>
        @endif

        </div>


<div class="nav-tabs-custom">
			<table class="table table-bordered table-striped">
				<thead>
					<tr class="bg-success" style="font-family: cursive;font-size: 14px">
						<td class="text-bold text-white">SL</td>
						<td class="text-white">Raw Material </td>
						<td class="text-white">Unit</td>
						<td class="text-white">Quantity</td>
						<td class="text-white">Rate</td>
						<td class="text-white">Action</td>
					</tr>
				</thead>
				<tbody>
          @php
              $i = 1;
          @endphp
					  
            @foreach ($raw_mat as $item)
                
           
					<tr> 
						<td>{{ $i++ }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->unit }} <code>{{ '('.$item->unit_use_unit .' X '. $item->use_unit .')' }} </code> </td>
						<td>
							<input type="number"  class="form-control" 
								id="quantity{{ $item->id }}" value="1" min="0" step="any"
								size="2" style="text-align: center; font-family: cursive; height: 25px; width: 80px; font-size: 20px;"  />
						</td>
						<td>
							<input type="number"  class="form-control" 
								id="rate{{ $item->id }}"  min="0" step="any"
								value="0" 
								style="text-align: center; font-family: cursive; height: 25px; width: 120px; font-size: 20px;"  />
						</td>
						<td>
							<span class="btn btn-primary btn-block" 
								onclick="return add_product('{{$item->name}}','{{$item->id}}' )">
								<i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i>
							</span>
						</td>
					</tr>
					  @endforeach 
				
					  
			 
				</tbody>
			</table>
		</div>




</div>

<div class="col-sm-6" style=" padding-right: 8px !important; padding-left: 8px !important; ">



<h4 class="bg-success text-center text-white py-2">Invoice Summery</h4>
	

		<form action="https://stitbd.com/restaurantpos/savePurchase" method="post"> 
			<input type="hidden" name="unique_form_id"  id="unique_form_id" value="15529549821636000584.566ac2aad8cf2fed8f08c65fc3f5b2f36a8" />
			<input type="hidden" name="total_item_qty"  id="total_item_qty" value="" />
			<input type="hidden" name="fund_id"  id="confirm_fund_id" value="0" />
			<input type="hidden" name="supplier_id" id="confirm_supplier_id" value="0"/> 
			<input type="hidden" name="supplier_name" id="confirm_supplier_name" value="">
			<input type="hidden" name="supplier_address" id="confirm_supplier_address" value="">
			<input type="hidden" name="supplier_invoice" id="confirm_supplier_invoice" value="">

			<table class="table table-bordered table-striped"  style="background-color:white;width: 100%">
				<tbody>
					<tr>
						<th colspan="3" class="text-center">
							<span style="padding-left:5px"> Supplier Information </span> 
						</th>
					</tr>
					<tr>
						<th class="text-left" style="width: 25%;">
							<span style="padding-left:5px">Invoice</span> 
						</th> 
						<th class="text-center" style="width: 5%;">
							:
						</th> 
						<td class="text-left" style="width: 70%;">
							<span id="confirm_supplier_invoice_view">Not Confirm</span> 
						</td> 
					</tr>
					<tr>
						<th class="text-left">
							<span style="padding-left:5px">Name</span> 
						</th> 
						<th class="text-center" >
							:
						</th> 
						<td class="text-left">
							<span id="confirm_supplier_name_view">Not Confirm</span> 
						</td> 
					</tr>
					<tr>
						<th class="text-left ">
							<span style="padding-left:5px"> Address</span> 
						</th> 
						<th class="text-center" >
							:
						</th> 
						<td class="text-left">
							<span id="confirm_supplier_address_view">Not Confirm</span> 
						</td> 
					</tr>
				</tbody>
			</table>


			<div id="show_purchase_cart">


<div class="table-responsive">
<table class="table table-bordered " id="order_products_list">


    <tr>
        <th class="text-center">#</th>
        <th class="text-center">Item</th>
        <th class="text-center">Qty</th>
        <th class="text-center">Rate</th>
        <th class="text-center">Payable</th>

    </tr>

@if ($order_purchase !== null)
   


    <tbody role="order_list">

    </tbody>


 @endif

  </table>

</div>
				
			</div>






<div class="col-md-12">
					<div class="form-group col-md-6"> 
						<label for="purchase_date">Purchase Date </label>
						@php
							$mytime = Carbon\Carbon::now();
						@endphp
						<input type="date" name="purchase_date" id="purchase_date" value="{{ $mytime }}" class="form-control"  style="background: #fff; font-family: cursive;">
					</div> 
					<div class="form-group col-md-6">
						<label> Purchase Type </label>
						<select class="form-control select2 purchase_status" name="purchase_status"  id="purchase_status"  style="font-family: serif;font-weight: bold">
							<option value="restaurant">Restaurant</option>
							<option value="factory">Factory</option>
						</select>
					</div>
				</div>

        <input type="hidden" value="" id="purchase_input">

				<div class="col-md-12 d-none" id="factory_div">
					<div class="form-group col-md-12"> 
						<label> Factory </label>
						<select class="form-control select2 factory_value" name="factory_id"  id="factory_id"  style="font-family: serif;font-weight: bold">
							<option value="0">Select Factory</option>
              @foreach ($factories as $factory)
                  		<option value="{{ $factory->name }}">{{ $factory->name }}</option>
              @endforeach
													
							</select>
					</div>
					</div>
      {{--  --------------------------------   --}}
		
<div class="row" id="invoice_body">
    <div class="col-md-12 "> 

        <div class="row mt-3">
        <div class="form-group col-md-6"> 
            <label for="grand_amount">Grand Amount </label>
            <input type="number" name="grand_amount" id="grand_amount_id" value="0.00" class="form-control grand_amount" readonly  style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 
        <div class="form-group col-md-6"> 
            <label for="discount_amount">Discount Amount <span id="view_percent_discount"></span></label>
            <input type="number" name="discount_amount" id="discount_amount_id" value="0.00" class="form-control discount_amount" readonly style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
            <input type="hidden" name="flat_discount_amount" id="flat_discount_amount" value="0">
            <input type="hidden" name="percentage_discount_amount" id="percentage_discount_amount" value="0">
        </div> 
        </div>

        <div class="row mt-3">

  
        <div class="form-group col-md-6"> 
            <label for="payable_amount">Payable Amount </label>
            <input type="number" name="payable_amount" id="payable_amount_id" value="0.00" class="form-control payable_amount" readonly style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 

        </div>

        <div class="row mt-3">

        <div class="form-group col-md-6"> 
            <label for="paid_amount">Paid Amount </label>
            <input type="number" name="paid_amount" id="paid_amount_id" value="0.00" class="form-control" readonly   style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 
        <div class="form-group col-md-6"> 
            <label for="change_amount">Change Amount </label>
            <input type="number" name="change_amount" id="change_amount_id" value="0.00" class="form-control" readonly  style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 
        </div>

<input type="hidden" id="total_payable_id">
    

    </div>





    </div>


 {{--  @php
     session()->forget('purchase_id');
 @endphp  --}}



			<div class="row">
				<div class="col-md-12 d-none" id="bill_payment_div" style="margin-top: 10px; ">
					<div class="box box-primary" style="padding:0px;">
						<div class="box-header with-border" >
							<h3 class="box-title">
									Bill Payment
							</h3>
						</div>
						<div class="box-body" style="padding:0px">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">

										<label> Fund :</label>
										<select class="form-control select2 fund_entry_value"  id="" style="font-family: serif;font-weight: bold">
                      @foreach ($fund as $item)

                      <option value="{{ $item->name }}">{{ $item->name }}</option>

                      @endforeach
																					
																					</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Amount :</label>
										<input type="number" id="confirm_paid_amount" class="form-control" placeholder="0.00 " min="0">
									</div>
								</div>
								<div class="col-md-4">
									<button type="button" style="margin-top: 24px" class="btn btn-primary btn-block btn-sm" onclick="return add_payment();">
										Paid
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 d-none" id="bill_discount_div" style="margin-top: 10px; ">
					<div class="box box-primary" style="padding:0px;">
						<div class="box-header with-border">
							<h3 class="box-title"> Bill Discount</h3>
						</div>
						<div class="box-body" style="padding:0px">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label for="percent_discount_amount"> Percentage </label>
										<input type="number" class="form-control" id="percent_discount_amount_input" placeholder="0.00 " style="font-weight: bold" min="0">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="flat_discount_amount"> Flat Amount </label>
										<input type="number" class="form-control" id="flat_discount_amount_input" placeholder="0.00 " style="font-weight: bold" min="0">
									</div>
								</div>
								<div class="col-md-3">
									<button type="button" class="btn btn-primary btn-block btn-sm"
									style="margin-top: 25px"
									onclick="return add_discount();">
										Discount
									</button>
								</div>
							</div>
						</div>
					</div>
				</div> 

				<div class="col-md-12 d-none" id="supplier_div" style="margin-top: 10px; ">
					<div class="box box-primary" style="padding:0px;">
						<div class="box-header with-border" >
							<h3 class="box-title">
								Supplier 
							</h3>
						</div>
						<div class="box-body" style="padding:0px" >
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Invoice :</label>
										<input type="text"  id="supplier_invoice" class="form-control" placeholder="Supplier Invoice">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Select Supplier :</label>
										<select class="form-control select2 supplier_company"  id="" style="font-family: serif;font-weight: bold">
                                            @foreach ($supplier as $item)
                                         <option value="{{ $item->name }}">{{ $item->name }}</option>

                                            @endforeach
																					</select>
									</div>
								</div>

								<div class="col-md-12" id="supplier_name_div">
									<div class="form-group">
										<label>Supplier Name :</label>
										<input type="text"  id="supplier_name" class="form-control" placeholder="Supplier Name">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<label>Address :</label>
										<textarea  id="supplier_address"  rows="2" class="form-control" placeholder="Supplier Address"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<button type="button" style="margin-top: 10px" class="btn btn-primary btn-block btn-sm" onclick="return add_supplier();">
										Confirm Supplier
									</button>
								</div>
							</div>
						</div>
					</div>





</div>


    <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px"> 
 <div class="d-flex flex-wrap text-white">
        <div class="col-md-4 " style="padding: 5px !important; ">
            <button type="button" onclick="view_payment()" class="btn btn-primary btn-block text-white">Payment</button>
        </div>
        <div class="col-md-4 "  style="padding: 5px !important; "> 
            <button type="button" onclick="view_discount()" class="btn btn-primary btn-block text-white">Discount</button>
        </div>
        <div class="col-md-4 "  style="padding: 5px !important; ">
            <button type="button" onclick="view_supplier()" class="btn btn-primary btn-block text-white">Supplier</button>
        </div>
 </div>
    </div>




</div>




			</div> 



    </section> 
</div>

<script>

	function view_payment(){
	$('#bill_payment_div').toggleClass('d-none');

    $('#bill_discount_div').addClass('d-none');
    $('#supplier_div').addClass('d-none');
	}

	function view_discount(){
		  $('#bill_discount_div').toggleClass('d-none');


   $('#bill_payment_div').addClass('d-none');
   $('#supplier_div').addClass('d-none');
	}

	function view_supplier(){
		 $('#supplier_div').toggleClass('d-none');

    $('#bill_payment_div').addClass('d-none');
    $('#bill_discount_div').addClass('d-none');

	}


$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    cache: false,
  });

function add_product(name, id){

  var name = name;
  var id = id;

  var qty = $('#quantity'+id).val();
  var rate = $('#rate'+id).val();
  var date = $('#purchase_date').val();
  var type = $('#purchase_input').val();
  var fund = $('#fund_id').val();
  var amount = $('#paid_amount').val();
  var supplier_name = $('#supplier_name').val();
  var supplier_address = $('#supplier_address').val();
  var supplier_invoice = $('#supplier_invoice').val();
  var supplier_company = $('#supplier_id').val();




  $.ajax({
     url: "{{asset('/')}}admin/purchase/count_purchase",
     dataType: 'json',
     cache: false,
     type: 'post',
     data:{
 
 name:name,
 qty:qty,
 rate:rate,
 type:type,
 date:date,
 fund:fund,
 amount:amount,
 supplier_name:supplier_name,
 supplier_address:supplier_address,
 supplier_invoice:supplier_invoice,
 supplier_company:supplier_company,




     },

     success:function(data){
      

         
         if(data === 'yes'){
             location.reload();
           
         }

        show_all_data();
		set_order_data();
           
     },
     error:function(data){

show_all_data();
set_order_data();
	
     }
 });



}




$(document).ready(function() {

  var type;


    $(document).on('change', '.purchase_status', function() {
 
if ($('.purchase_status').val() === 'restaurant') {

  $('#factory_div').addClass('d-none');

    var air_id =  $('.purchase_status').val();     // get id the value from the select

        $('#purchase_input').val(air_id);   // set the textbox value
}
      



// var purchase_status = $('#purchase_input').val();

  if ($('.purchase_status').val() === 'factory') {

       
$('#factory_div').removeClass('d-none');
   $(document).on('change', '.factory_value', function() {

 
var air_id =  $('.factory_value').val();

 $('#purchase_input').val(air_id);


     });

 }

 

    });


    
});


show_all_data();

  function show_all_data(){

    $.ajax({
      
      type:'get',
      dataType:'json',
      url:"{{asset('/')}}admin/purchase/show_all_data",
      cache: false,
      success:function(response){
        
     
      
            var data = "";

var i = 1;
// var total = 0;
// var discount = 0;
// var vat = 0;

 $.each(response, function(key, value){


    var rate = parseInt(value.rate);
   
  data = data + "<tr>"

    data = data + "<td class='text-center'>"+ 
"<button type='button' onclick ='return delete_order_purchase("+value.id+");' class='btn btn-danger '>" + "x" + "</button>" 
+ "</td>"

     data = data + "<td class='text-center'>"+  value.name + "</td>"
     data = data + "<td class='text-center'>"+  value.qty + "</td>"
     data = data + "<td class='text-center'>"+  value.rate + "</td>"
    
     data = data + "<td class='text-center'>"+  value.payable + "</td>"



   data = data + "</tr>"


// total += parseInt(value.payable) ;

// discount += parseInt(value.discount);
// vat += parseInt(value.vat);
  


 });



 $('tbody[role="order_list"]').html(data); 



      },

    });

  }

  function delete_order_purchase(id){

    $.ajax({
    
      type:'delete',
      dataType:'json',
      url:"{{asset('/')}}admin/purchase/"+id,
      cache: false,
      data:{
        id:id,

      },
      success:function(data){
        
      
	      set_order_data()
		  show_all_data();


      },

	  error: function(data){
		  set_order_data()
		  show_all_data();
	  }

    });
  }



  function add_payment(){
    // user given amount 

	$('#bill_discount_div').addClass('d-none');

    var  confirm_paid = $('#confirm_paid_amount').val();
    var fund = $('.fund_entry_value').val();

	$('#bill_payment_div').addClass('d-none');

	

    $.ajax({
     url: "{{asset('/')}}admin/purchase/paid_amount",
     dataType: 'json',
     cache: false,
     type: 'post',
     data:{
     confirm_paid:confirm_paid,
	 fund:fund,
     },

     success:function(value){

		$change = (value.total_payment - value.total_with_discount);

		$('#paid_amount_id').val(value.total_payment);
		$('#change_amount_id').val($change);

		set_order_data()
		show_all_data();

		
     },
     error:function(data){
       console.log('error :'+data);
     }
 });



  }


  function add_supplier(){
	  
	var supplier_company = $('.supplier_company').val();
	var supplier_name = $('#supplier_name').val();
	var supplier_address = $('#supplier_address').val();
	var supplier_invoice = $('#supplier_invoice').val();

	$('#supplier_div').addClass('d-none');


	    $.ajax({
     url: "{{asset('/')}}admin/purchase/supplier",
     dataType: 'json',
     cache: false,
     type: 'post',
     data:{
     supplier_company:supplier_company,
	 supplier_name:supplier_name,
	 supplier_address:supplier_address,
	 supplier_invoice:supplier_invoice,
     },

     success:function(value){
	    set_order_data()
		show_all_data();
		
     },
     error:function(data){
       	set_order_data()
		show_all_data();
     }
 });


  }


  function confirm_purchase(){

  var date = $('#purchase_date').val();
  var type = $('#purchase_input').val();

    $.ajax({
      
      type:'get',
      dataType:'json',
      cache: false,
      url:"{{asset('/')}}admin/purchase/confirm",
      data:{
        date:date,
		type:type,
      },
  
      success:function(data){
        
        location.reload();

	    set_order_data()
		show_all_data();

        
      },

    });
    
 }

set_order_data();

function set_order_data(){

        $.ajax({
      
      type:'get',
      dataType:'json',
      cache: false,
      url:"{{asset('/')}}admin/purchase/order_data",
      data:{
      
      },
  
      success:function(data){

        
           $('#grand_amount_id').val(data.total_rate);
           $('#discount_amount_id').val(data.total_discount);
           $('#payable_amount_id').val(data.total_with_discount);
           $('#paid_amount_id').val(data.total_payment);


         


      },

	  error:function(error){
		  console.log(error);
	  }

    });
    
 }

 function add_discount(){

var flat_dis = $('#flat_discount_amount_input').val();
var percent_dis = $('#percent_discount_amount_input').val();



$('#bill_discount_div').addClass('d-none');

	 $.ajax({
     url: "{{asset('/')}}admin/purchase/discount",
     dataType: 'json',
     cache: false,
     type: 'get',
     data:{
     flat_dis:flat_dis,
	 percent_dis:percent_dis,
     },

     success:function(value){

         set_order_data()
		 show_all_data();

var discount = value.total_discount;

var change = parseInt(value.total_payment) - parseInt(value.total_with_discount);


		 $('#discount_amount_id').val(discount);
		 $('#discount_amount_id').val(change);


      
     },
     error:function(data){
       console.log(data);
     }
 });
 }

 function cancel_purchase(){


	    $.ajax({
      
      type:'get',
      dataType:'json',
      cache: false,
      url:"{{asset('/')}}admin/purchase/cancel",
   
      success:function(data){
        location.reload();
        show_all_data();

      },

    });
 }
    
</script>
@endsection

