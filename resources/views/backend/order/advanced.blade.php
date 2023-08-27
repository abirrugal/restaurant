
@extends('backend.layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 506px;"> 
    <section class="content-header">

 {{--  {{dd(session('order_id'))}}  --}}
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link " aria-current="page" href="#">All</a>
  </li>
  @php
  $segments = request()->segments();
@endphp

  @foreach ($categories as $category)
  
  <li class="nav-item" >
  
    <a class="nav-link {{ (last($segments) == $category->id) ? 'active' : ''  }}"  onclick="list_active()" href="{{route('admin.order.advanced.product', $category->id)}}">{{$category->name}}</a>
  </li>
  @endforeach




</ul>


        <code>
                <span class="glyphicon glyphicon-cog" style="color: #3C8DBC"></span>
                                            <span style="color:#3C8DBC">Product Sale</span>
                                </code> 
    </section> 
    <section class="content container-fluid"> 



<input type="hidden" id="row_id" value="">

<div class="row">
<div class="col-sm-8" style=" padding-right: 8px !important; padding-left: 8px !important; "> 
<div class="nav-tabs-custom">


    
<div class="tab-content">


                            <div class="tab-pane active" id="tab_15">
                <b class="text-bold">
                    <span class="glyphicon glyphicon-refresh"></span>
                     Wings</b>
                <hr>

                <table class="table table-bordered table-striped ">
                    <thead> 
                        <tr class="bg-success text-white  " style="font-family: cursive;font-size: 14px">
                            <td class="text-bold py-3">Picture</td>
                            <td class="text-bold py-3">Product</td>
                            <td class="py-3">Quantity</td>
                            <td class="py-3">Rate</td>
                            <td class="py-3">Flavor/Chocolate Flavor</td>
                            <td class="py-3">Parcel</td>
                            <td class="py-3">Action</td>
                        </tr>
                    </thead>
                    <tbody>



{{-- 1st item --}}

                      @foreach ($products as $product)
                          

                      <form action="" method="POST">
                          @csrf
                        <tr>
                            <td>
                            <img class="img-responsive" src="{{asset($product->image)}}" alt="BBQ Wings" style="height: 80px; width: 120px; padding: 3px;">

                            </td>
                            <td>{{$product->name}}</td>
                            <td><input type="number" class="form-control" id="{{$product->id}}" onclick="return getValueProqty(this)"  value="1" size="2" style="text-align: center; font-family: cursive; height: 60px; width: 90px; font-size: 46px;"></td>
                            <td>
                                <span style="font-size: 20px; font-weight: bold;">{{$product->rate}}</span>
                                <input type="hidden" value="{{$product->rate}}" name="rate">
                                <input type="hidden" id="rate" value="150">
                            </td>
                            <td>
                                <div class="mt-2">
                                @if ($product->flavor === 'yes')
                                <b>Flavor</b> <br>
                                 
                                    @foreach ($flavor as $item)
                                    <input type="radio" name="flavor" id="flavor_name" onclick="return getValue(this)" value="{{$item->name}}">{{$item->name}}<br>

                                    @endforeach    
                                @endif
                                </div>
                                <div class="mt-2">
                                @if ($product->c_flavor === 'yes')
                                <b>Chocolate Flavor</b> <br>
                                 
                                    @foreach ($c_flavor as $item)
                                    <input type="radio" name="c_flavor" id="c_flavor_name" onclick="return getValueC_flavor(this)" value="{{$item->name}}">{{$item->name}}<br>

                                    @endforeach    
                                @endif
                                </div>
                                 
                         </td>

                            <td>
                                <input type="radio" name="parcel_sts" class="parcely" id="parcely" value="yes"> Yes <br>
                                <input type="radio" name="parcel_sts" class="parceln" id="parceln" value="no"> No
                            </td>

                            <input type="hidden" name="vat" value="{{$product->vat}}">
                            <input type="hidden" name="sd_paid" value="{{$product->sd_paid}}">
                            <input type="hidden" name="sd_drink" value="{{$product->sd_drink}}">

                            <td>

                               
                                <span class="btn btn-primary btn-block" onclick="return add_product('{{$product->rate}}','{{$product->vat + $product->sd_paid + $product->sd_drink}}', '{{$product->name}}' ,'{{$product->id}}')"><i class="fa fa-check" aria-hidden="true"></i>
                                    <span style="padding-left: 5px"> 
                                       
                                        Add 
                                   
                                
                                </span></span>

                                {{--  <span class="btn btn-success btn-block mt-2" onclick="return confirm_product('{{$product->rate}}','{{$product->vat + $product->sd_paid + $product->sd_drink}}', '{{$product->name}}' ,'{{$product->id}}')"><i class="fa fa-check" aria-hidden="true"></i>
                                    <span style="padding-left: 5px"> 
                                       
                                        Confirm 
                                   
                                
                                </span></span>  --}}
                            

                            </td>
                        </tr>

                        </form>

                        @endforeach 





{{-- 2nd item  --}}
                          
                 
                          
                        {{--  <tr>
                            <td>

                            </td>
                            <td>Hot Wings</td>
                            <td><input type="number" class="form-control" id="qty65" value="1" size="2" style="text-align: center; font-family: cursive; height: 60px; width: 90px; font-size: 46px;"></td>
                            <td>
                                <span style="font-size: 20px; font-weight: bold;">150</span>
                                <input type="hidden" id="rate" value="150">
                            </td>
                            <td>
                                                                                <b>Flavor</b> <br>
                                 
                                        <input type="radio" name="flavor65" value="3">Extra Spicy<br>
                                 
                                        <input type="radio" name="flavor65" value="2">Spicy<br>
                                 
                                        <input type="radio" name="flavor65" value="1">Reguler<br>
                                                                                                                    </td>
                            <td>
                                <input type="radio" name="parcel65" value="1"> Yes <br>
                                <input type="radio" name="parcel65" value="0"> No
                            </td>
                            <td><span class="btn btn-primary btn-block" onclick="return add_product('65', 'Hot Wings', '150')"><i class="fa fa-check" aria-hidden="true"></i><span style="padding-left: 5px">Add</span></span></td>
                        </tr>  --}}
                         
                    </tbody>
                </table>
            </div> 



<div class="p-3 border">{{$products->links()}}</div>


            


    

         
</div> 
</div>
</div>
<div class="col-sm-4" style=" padding-right: 8px !important; padding-left: 8px !important; ">





    <div class="">
        @php
            $id = session('order_id');
        @endphp


@if(session('order_id') !== null)
<button class="btn btn-danger my-2  w-100 " id="cancel_order_id" onclick="return cancel_order('{{$id}}');">Cancel Order</button>
@endif

@if(session('order_id') !== null)

<form class="me-2 w-100 d-block" action="{{ route('admin.order.advanced_confirm_order') }}" method="GET">





        <input type="hidden" name="paid" id="paid">
        <button class="btn btn-success  me-2 my-2 w-100 " id="confirm_order_id" onclick="confirm_order('{{$id}}')">
        Confirm Order </button>



        <div class="col">
            <div class="mb-3 form-group">
            <label for="slider_image" class="form-label text-black h6">Select Add Ones</label>
            <select  class="form-select custom-select js-example-basic-multiple form-control addone_ids" multiple="multiple" name="addone_ids[]" id="addone_ids"  aria-label="Default select example" placeholder="Select from avilable free room">
              @foreach ($addones as $item)
                  
              
              <option value="{{$item->id}}" >{{$item->name}}</option>
              
              @endforeach
            </select>
          </div>  
        
          </div> 

</form>
@endif


      

</div>




<h4 class="bg-success text-white h5 p-3">Invoice Summery</h4>






<table class="table table-bordered table-striped"  style="background-color:white;width: 100%">
    <tbody>
        <input type="hidden" name="unique_form_id"  id="unique_form_id" value="7951514541635564919.5132e341ff4e44a7b9c58bf563cede81440e" />
        <input type="hidden" name="total_item_qty"  id="total_item_qty" value="" />
        <input type="hidden" name="fund_id"  id="fund_id" value="" />
        <input type="hidden" name="token" id="token_value" value="" />
        <input type="hidden" name="order_type" id="get_order_type" value="Regular">
        <input type="hidden" name="current_serial" id="current_serial" value="1">
        <tr>
            <th class="text-center" style="width: 40%;">
                <span class="glyphicon glyphicon-upload"></span>
                <span style="padding-left:5px">Token :</span> 
            </th>

          
       

                <td style="width: 60%;">
                    <span class="text-dark" id="confirm_token"></span> 
                </td> 
    
            

        </tr>

        <tr>
            <th class="text-center">
                <span style="padding-left:5px">Table Number :</span>  
            </th>
            <td>
                <span id="confirm_table" class="badge bg-secondary" style="color:white"></span>
            </td> 
        </tr>

     

        <tr>
            <th class="text-center">
                <span style="padding-left:5px">Delivery Date :</span>  
            </th>
            <td>
                <input type="date" name="delivery_date" value="{{old('delivery_date')}}" id="delivery_date"  class="form-control" >
            </td> 
        </tr>
        <tr>
            <th class="text-center">
                <span style="padding-left:5px">Customer Name :</span>  
            </th>
            <td>
                <input type="text" name="customer_name" id="customer_name" value="{{old('customer_name')}}" class="form-control" placeholder="Customer Name" required>
            </td> 
        </tr>
        <tr>
            <th class="text-center">
                <span style="padding-left:5px">Customer Number :</span>  
            </th>
            <td>
                <input type="text" name="customer_contact_number" value="{{old('customer_contact_number')}}" id="customer_contact_number" class="form-control" placeholder="Customer Contact Number" required onfocusout="returnCustomerInformation()">
            </td> 
        </tr>
        <tr>
            <th class="text-center">
                <span style="padding-left:5px">Customer Address :</span>  
            </th>
            <td>
                <textarea name="customer_address" id="customer_address" value="{{old('customer_address')}}" class="form-control" placeholder="Customer Address" required></textarea>
            </td> 
        </tr>
        <tr>
            <th class="text-center">
                <span style="padding-left:5px">Order Note:</span>  
            </th>
            <td>
            <textarea name="order_note" id="order_note" class="form-control" placeholder="Order Note">{{old('customer_address')}}</textarea>
            </td> 
        </tr>
    </tbody>
</table>

{{-- <div class="d-flex">
    <div class="form-group mx-sm-3 mb-2">
      <label for="inputPassword2" class="sr-only">Table Number</label>
      <input type="text" class="form-control" id="table_no" placeholder="Table No.">
    </div>
    <button type="button" class="btn btn-primary mb-2" onclick="add_table()">Update Table No.</button>
</div> --}}


<div id="show_sales_cart">
    
</div>







<form action="" method="post"> 



<input type="hidden"  class="pro_qty" value="1">
<input type="hidden" class="product_id">
<input type="hidden" class="product_name">

<div class="table-responsive">
<table class="table table-bordered " id="order_products_list">


    <tr>
        <th class="text-center">#</th>
        <th class="text-center">Item</th>
        <th class="text-center">Qty</th>
        <th class="text-center">Rate</th>
        <th class="text-center">Vat</th>
        <th class="text-center">Payable</th>

    </tr>

@if ($order_products !== null)
   
{{-- @foreach ($order_products as $item) --}}
  
    
{{-- <tr>
    <td class="text-center">
     
    
        <button class="btn btn-danger px-1 py-0" type="button" onclick="return delete_order_product('{{$item->id}}')">
            X
        </button>
       

        

    </td>
    <td class="text-center table_name"></td>
    <td class="text-center table_qty"></td>
    <td class="text-center table_rate"></td>
    <td class="text-center table_vat"></td>
    <td class="text-center table_amount"></td>
</tr> --}}
    

{{-- @endforeach --}}



        <tbody role="order_list">

    </tbody>






  

@endif



  </table>

</div>




<div class="row" id="invoice_body">
    <div class="col-md-12 "> 

        <div class="row mt-3">
        <div class="form-group col-md-6"> 
            <label for="grand_amount">Grand Amount </label>
            <input type="number" name="grand_amount" id="" value="0.00" class="form-control grand_amount" readonly  style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 
        <div class="form-group col-md-6"> 
            <label for="discount_amount">Discount Amount <span id="view_percent_discount"></span></label>
            <input type="number" name="discount_amount" id="" value="0.00" class="form-control discount_amount" readonly style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
            <input type="hidden" name="flat_discount_amount" id="flat_discount_amount" value="0">
            <input type="hidden" name="percentage_discount_amount" id="percentage_discount_amount" value="0">
        </div> 
        </div>

        <div class="row mt-3">

        <div class="form-group col-md-6"> 
            <label for="vat_amount">Vat Amount </label>
            <input type="number" name="vat_amount" id="" value="0.00" class="form-control vat_amount" readonly   style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div>
        <div class="form-group col-md-6"> 
            <label for="payable_amount">Payable Amount </label>
            <input type="number" name="payable_amount" id="" value="0.00" class="form-control payable_amount" readonly style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 

        </div>

        <div class="row mt-3">

        <div class="form-group col-md-6"> 
            <label for="paid_amount">Paid Amount </label>
            <input type="number" name="paid_amount" id="paid_amount" value="0.00" class="form-control" readonly   style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 
        <div class="form-group col-md-6"> 
            <label for="change_amount">Change Amount </label>
            <input type="number" name="change_amount" id="change_amount" value="0.00" class="form-control" readonly  style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
        </div> 
        </div>


    

    </div>

    <div class="col-md-12 d-none" id="bill_discount_div" style="margin-top: 10px; ">
        <div class="box box-primary" style="padding:0px;">
            <table class="table table-bordered">
                <tr>
                    <td style="width: 30%">Flat Discount</td>
                    <td style="width: 30%"><input type="number" id="confirm_flat_discount" class="form-control" placeholder="0.00" min="1" /></td>
                    <td style="width: 40%"><button type="button" class="btn btn-primary" onclick="return flat_discount();"><i class="glyphicon glyphicon-ok"></i><span style="padding-left:5px ">Add Flat</span></button></td>
                </tr>
                <tr>
                    <td> Discount(%)</td>
                    <td><input type="number" id="confirm_percent_discount" class="form-control" placeholder="0%" min="0"/></td>
                    <td><button type="button" class="btn btn-primary"  onclick="return percent_discount();"><i class="glyphicon glyphicon-ok"></i><span style="padding-left:5px ">Add Parcent</span></button></td>
                </tr> 
            </table> 
        </div>
    </div>



    </div>









 


    <div class="col-md-12 d-none" id="bill_token_div" style="margin-top: 10px;">
        <div class="box box-primary" style="padding:0px;">
            <table class="table table-bordered">
                <tr>
                    <td>
                        <textarea name="token_no" id="token_no" class="form-control" placeholder="Token No"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><button type="button"  class="btn btn-primary btn-block" onclick="return add_token();"><i class="glyphicon glyphicon-ok"></i><span style="padding-left:5px">Add Token</span></button></td>
                </tr>
           
            
            </table> 
        </div>
    </div>



    <div class="col-md-12 mt-3 d-none" id="bill_payment_div" style="margin-top: 10px; ">
        <div class="box box-primary" style="padding:0px;">
            <table class="table table-bordered" style="max-width: 500px;">
                <tr>
                    <td style="width: 30%" class="text-bold text-right">Payment  </td>
                    <td style="width: 70%" colspan="2">
                        <select class="form-control form-control-lg input-sm select2 " name="confirm_fund_id" id="confirm_fund_id" style="width: 100%;font-weight: bold">

                            @foreach ($funds as $item)

                            <option title="{{$item->name}}" value="{{$item->name}}">{{$item->name}}</option>

                            @endforeach
        
                   </select>
                    </td>
                </tr>
                <tr>
                    <td class="text-right text-bold"> Amount</td>
                    <td><input type="number" id="confirm_paid_amount" min="1" class="form-control" style="width:100%" placeholder="0.00"/></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center "><button type="button" class="btn btn-primary" onclick="return paid_amount_con();"><i class="glyphicon glyphicon-saved"></i><span style="padding-left:5px">Confirm Payment</span></button></td>
                    
                </tr> 
            </table> 
        </div>
    </div>




    <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px"> 
 <div class="d-flex flex-wrap text-white">
        <div class="col-md-4 " style="padding: 5px !important; ">
            <button type="button" onclick="view_token()" class="btn btn-primary btn-block text-white">Token</button>
        </div>
        <div class="col-md-4 "  style="padding: 5px !important; "> 
            <button type="button" onclick="view_discount()" class="btn btn-primary btn-block text-white">Discount</button>
        </div>
        <div class="col-md-4 "  style="padding: 5px !important; ">
            <button type="button" onclick="view_payment()" class="btn btn-primary btn-block text-white">Payment</button>
        </div>
 </div>
    </div>


</div> 
</form>






</div>








</div>



    </section> 
</div>

<script>



function view_discount(){
   $('#bill_discount_div').toggleClass('d-none');


   $('#bill_payment_div').addClass('d-none');
   $('#bill_token_div').addClass('d-none');

}

function view_payment(){
    $('#bill_payment_div').toggleClass('d-none');

    $('#bill_discount_div').addClass('d-none');
    $('#bill_token_div').addClass('d-none');

}


function view_token(){
    $('#bill_token_div').toggleClass('d-none');

    $('#bill_payment_div').addClass('d-none');
    $('#bill_discount_div').addClass('d-none');
}

show_all_data();
show_customer_info();

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    cache: false,
  });






// Token Set 

function add_token(){
   var token_value = $('#token_no').val();
   
   if(token_value !== null && token_value !== ''){
    $('#confirm_token').text(token_value);
    $('#bill_token_div').addClass('d-none');


    $.ajax({
      
      type:'get',
      dataType:'json',
      url:"{{asset('/')}}admin/order/token_add",
      cache: false,
      data:{
        token_value:token_value,

      },
      success:function(data){
        
        // alert(data);


        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });

        Toast.fire({
       
        title: data,
        });

        // show_all_data();


      },

    });

   }
   

}


//Table Number Set



function add_table(){

    var table_no = $('#table_no').val();

   if(table_no !== null && table_no !== ''){
       
    $('#confirm_table').text(table_no);
    // $('#bill_token_div').addClass('d-none');


    $.ajax({
      
      type:'get',
      dataType:'json',
      url:"{{asset('/')}}admin/order/table_add",
      cache: false,
      data:{
        table_no:table_no,

      },
      success:function(data){
        
        // alert(data);

        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        });

        Toast.fire({
    
        title: data,
        });

        // show_all_data();


      },

    });

   }else{
       alert('Please enter table number. Note: You must add at least one item to add table number.');


   }
   

}


  function getValue(data){
  


  $('#flavor_name').val(data.value);


  }
  function getValueC_flavor(data){
    $('#c_flavor_name').val(data.value);
  }

  function getValueProqty(data){

    //   $('.pro_qty').val(data.value);
      
  }



  function paid_amount_con(){
    // user given amount 

    var  confirm_paid  = $('#confirm_paid_amount').val();

    var  fund_name     =     $('#confirm_fund_id').val()
      
$('#bill_payment_div').toggleClass('d-none');

    $.ajax({
     url: "{{asset('/')}}admin/order/paid_amount",
     dataType: 'json',
     cache: false,
     type: 'get',
     data:{
     confirm_paid:confirm_paid,
     fund_name:fund_name,
     },

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


     var change =  parseInt(total_paid) - parseInt(value.total_with_discount);






$('.grand_amount').val(value.total);
 $('.discount_amount').val(value.total_discount);
  $('.vat_amount').val(value.total_vat);

 $('.payable_amount').val(value.total_with_discount);
 $('#paid_amount').val(total_paid);
 $('#change_amount').val(change);

      
     },
     error:function(data){
       console.log('error :'+data);
     }
 });





  }

   function add_product(rate,vat, name, id){

var id = id;



$('#view_percent_discount').text('');

$('.product_name').val(name);
$('.product_id').val(id);

var product_qty = $('#'+id).val();


$('.pro_qty').val(product_qty);



var percel_sts = $('input[name="parcel_sts"]:checked').val();


var discount_amount = $('.discount_amount').val();

    //  var product_qty = $('.pro_qty').val();

var grand_amount = product_qty * rate;
var vat_amount = product_qty * vat;

var fund = $('#confirm_fund_id').val();



   $('.grand_amount').val(grand_amount);


   $('.vat_amount').val(vat_amount);



var fee = grand_amount  + vat_amount ;


 $('.payable_amount').val(fee);



// -------------------------------------------------
// ----------------------------------------------------
// ----------------------------------------------------


    show_all_data();

var flavor = $('#flavor_name').val();
var c_flavor = $('#c_flavor_name').val();

var grand_amount = $('.grand_amount').val();
var vat_amount = $('.vat_amount').val();
var parcel_sts = $('input[name="parcel_sts"]:checked').val();
var discount_amount = $('.discount_amount').val();
var payable_amount = $('.payable_amount').val();

var fund = $('#confirm_fund_id').val();
var product_id = $('.product_id').val();

var name = $('.product_name').val();

var product_qty = $('.pro_qty').val();

var token_value = $('#confirm_token').text();




    $.ajax({
     url: "{{asset('/')}}admin/order/count_order",
     dataType: 'json',
     cache: false,
     type: 'get',
     data:{
        product_id:product_id,
        grand_amount:grand_amount,
        payable_amount:payable_amount,
        vat_amount:vat_amount,
        parcel_sts:parcel_sts,
        product_qty:product_qty,
        discount_amount:discount_amount,
        flavor:flavor,
        c_flavor:c_flavor,
        fund:fund,
        token_value:token_value,

     },

     success:function(value){
        
show_all_data();


         
         
         $('.pro_qty').val(1);

         

         if(value === 'yes'){
             location.reload();
           
         }
           
     },
     error:function(data){
        show_all_data();
     }
 })





   }




//    function confirm_product(rate,vat, name, id){


// var grand_amount = $('.grand_amount').val();
// var vat_amount = $('.vat_amount').val();
// var parcel_sts = $('input[name="parcel_sts"]:checked').val();
// var discount_amount = $('.discount_amount').val();
// var flavor = $('input[name="flavor"]:checked').val();
// var c_flavor = $('input[name="c_flavor"]:checked').val();
// var fund = $('#confirm_fund_id').val();


// var product_qty = $('#'+name).val();

//     $.ajax({
//      url: "{{asset('/')}}admin/order/count_order",
//      dataType: 'json',
//      type: 'post',
//      data:{
//        id:id,
//         grand_amount:grand_amount,
//         vat_amount:vat_amount,
//         parcel_sts:parcel_sts,
//         product_qty:product_qty,
//         discount_amount:discount_amount,
//         flavor:flavor,
//         c_flavor:c_flavor,
//         fund:fund,

//      },

//      success:function(data){
//          console.log(data);
//      },
//  })
//    }






  ///////// //FLAT DISCOUNT//////////
//   ------------------------------------




function flat_discount(){
     var flat_dis = $('#confirm_flat_discount').val();


// var flat_discount = $('.discount_amount').val(flat_dis);


    $.ajax({
     url: "{{asset('/')}}admin/order/flat_discount",
     dataType: 'json',
     cache: false,
     type: 'get',
     data:{
     flat_dis:flat_dis,
     },

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

      if (value.percent_discount !== null) {
        
        var percent_discount = '( ' +value.percent_discount + '% )';
    }else{
        var percent_discount = '( 0% )';
    }



var change = parseInt(total_paid) - parseInt(value.total_with_discount);


 $('.grand_amount').val(value.total);
 $('.discount_amount').val(value.total_discount);
  $('.vat_amount').val(value.total_vat);

 $('.payable_amount').val(value.total_with_discount);
 $('#paid_amount').val(total_paid);
 $('#change_amount').val(change);
 $('#view_percent_discount').text(percent_discount);


// search1

      
     },
     error:function(data){
       console.log('error :'+data);
     }
 });



  
  

   }




  function percent_discount(){

  var pecentage_entry_value = $('#confirm_percent_discount').val();


  $('#view_percent_discount').text('('+ pecentage_entry_value+'%)');

    var payable_amount = $('.payable_amount').val();

    $.ajax({
     url: "{{asset('/')}}admin/order/parcent_discount",
     dataType: 'json',
     cache: false,
     type: 'get',
     data:{
     pecentage_entry_value:pecentage_entry_value,
     },

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

//  $('#amount_with_dis').text();

var change = parseInt(total_paid) - parseInt(value.total_with_discount);

 
  $('.grand_amount').val(value.total);
 $('.discount_amount').val(value.total_discount);
  $('.vat_amount').val(value.total_vat);

 $('.payable_amount').val(value.total_with_discount);
 $('#paid_amount').val(total_paid);
 $('#change_amount').val(change);

      
     },
     error:function(data){
       console.log('error :'+data);
     }
 });
    


  }


  flat_discount();
   
  
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

    // if (value.percent_discount !== null) {
        
    //     var percent_discount = value.percent_discount;
    // }else{
    //     var percent_discount = 0;
    // }

//  $('#amount_with_dis').text();

var change = parseInt(total_paid) - parseInt(value.total_with_discount);


$('.grand_amount').val(value.total);
$('.discount_amount').val(total_discount);
$('.vat_amount').val(value.total_vat);

$('.payable_amount').val(value.total_with_discount);
$('#paid_amount').val(total_paid);
$('#change_amount').val(change);

// $('#view_percent_discount').text(value.percent_discount);

    
   },
   error:function(data){
     console.log('error :'+data);
   }
});
  


}


// function show_customer_info(){
    


//     $.ajax({
      
//       type:'get',
//       dataType:'json',
//       url:"{{asset('/')}}admin/order/show_customer_info",
//       cache: false,
//       success:function(response){
        

// $('#delivery_date').val(response.delivery_date);
// $('#customer_name').val(response.customer_name);
// $('#customer_contact_number').val(response.customer_number);
// $('#customer_address').val(response.customer_address);
// $('#order_note').val(response.note);
// $('#confirm_token').text(response.token);

 

//       },

//     });

// }

   function show_all_data(){

    $.ajax({
      
      type:'get',
      dataType:'json',
      url:"{{asset('/')}}admin/order/show_all_data",
      cache: false,
      success:function(response){
        
     $('#delivery_date').val(response.date);
     $('#customer_name').val(response.customer_name);



        $.each(response, function(key, value){
           
         

            var data = "";

var i = 1;
var total = 0;
 $.each(response, function(key, value){

    var rate = parseInt(value.rate);
    var vat = parseInt(value.vat);
   
  data = data + "<tr>"

    data = data + "<td class='text-center'>"+ 
"<button type='button' onclick ='return delete_order_product("+value.id+");' class='btn btn-danger '>" + "x" + "</button>" 
+ "</td>"

     data = data + "<td class='text-center'>"+  value.name + "</td>"
     data = data + "<td class='text-center'>"+  value.qty + "</td>"
     data = data + "<td class='text-center'>"+  value.rate + "</td>"
     data = data + "<td class='text-center'>"+  value.vat + "</td>"
    
     data = data + "<td class='text-center'>"+  value.payable + "</td>"



   data = data + "</tr>"


total += parseInt(value.payable) ;
 

 });



 $('tbody[role="order_list"]').html(data); 


    });

    // starting();

flat_discount();
      },

    });

    

   }




   

function delete_order_product(id){

    $.ajax({
      
      type:'delete',
      dataType:'json',
      url:"{{asset('/')}}admin/order/"+id,
      cache: false,
      data:{
        id:id,

      },
      success:function(data){
        
        show_all_data();
        show_customer_info();


      },

    });

}





function confirm_order(){
    var  confirm_paid = $('#confirm_paid_amount').val();
    $('#paid').val(confirm_paid);
   var addones = $('.addone_ids').val();

      var  confirm_paid = $('#confirm_paid_amount').val();
    var token_value = $('#confirm_token').text();

    var delivery_date = $('#delivery_date').val();
    var customer_name = $('#customer_name').val();
    var customer_contact_number = $('#customer_contact_number').val();
    var customer_address = $('#customer_address').val();
    var order_note = $('#order_note').val();
    
    var token_value = $('#confirm_token').text();


    $.ajax({
      
      type:'get',
      dataType:'json',
      cache: false,
      url:"{{asset('/')}}admin/order/advanced_confirm_order",
      data:{
        confirm_paid:confirm_paid,
        token_value:token_value,
        addones:addones,

        delivery_date:delivery_date,
        customer_name:customer_name,
        customer_contact_number:customer_contact_number,
        customer_address:customer_address,
        order_note:order_note,
      },
  
      success:function(data){
        
        location.reload();

        show_all_data();

        flat_discount();

        
      },

    });
    
}



// function confirm_order(){
//     var  confirm_paid = $('#confirm_paid_amount').val();
//     var token_value = $('#confirm_token').text();

//     var delivery_date = $('#delivery_date').val();
//     var customer_name = $('#customer_name').val();
//     var customer_contact_number = $('#customer_contact_number').val();
//     var customer_address = $('#customer_address').val();
//     var order_note = $('#order_note').val();


//     $.ajax({
      
//       type:'get',
//       dataType:'json',
//       cache: false,
//       url:"{{asset('/')}}admin/order/advanced_confirm_order",
//       data:{
//         confirm_paid:confirm_paid,
//         token_value:token_value,

//         delivery_date:delivery_date,
//         customer_name:customer_name,
//         customer_contact_number:customer_contact_number,
//         customer_address:customer_address,
//         order_note:order_note,
//       },
  
//       success:function(data){
        
//         location.reload();

//         show_all_data();
//         show_customer_info();
//       },

//     });
// }

function cancel_order(id){

    $.ajax({
      
      type:'get',
      dataType:'json',
      cache: false,
      url:"{{asset('/')}}admin/order/cancel",
   
      success:function(data){
        location.reload();
        show_all_data();
        show_customer_info();

      },

    });
}


$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
      

    });

    $('.js-example-basic-multiple2').select2({
      

    });

});
    
</script>
@endsection