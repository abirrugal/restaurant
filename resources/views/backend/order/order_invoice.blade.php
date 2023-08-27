@extends('backend.layout.master')
@section('main_content')
<div class="container">
       <div class="d-flex justify-content-end">
    <div class="btn btn-primary px-3 py-2 print">Print Invoice</div>
    </div>
</div>

<div class="container">

    <div id="voucher_invoice">

 

<div class="text-center">


    <div class="logo mb-3"><img src="https://quicktech-ltd.com/public/uploads/logo/quicktech-website-logo.png" alt=""></div>
    
<p class="fw-bold">Dhaka , Bangladesh</p>
<p class="fw-bold">Cell : Company Mobile Number</p>
<p class="fw-bold">Token No : <strong>{{ $order->token }}</strong></p>
{{-- BIN : 123456789 --}}
<p class="fw-bold">Order Type : Regular</p>
<p class="fw-bold mb-3">Served By : Super Admin</p>


<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Qty</th>
      <th scope="col">Rate</th>
      <th scope="col">Vat</th>
      <th scope="col">Subtotal</th>

    </tr>
  </thead>


  @foreach ($order->order_products as $order_item)
      

@php
   $rate = ($order_item->rate / $order_item->qty);

   
@endphp
      <tr>

      <td class="fw-bold" scope="col">
          {{ $order_item->name }}
     
          @isset($order_item->flavor)
              {{ ($order_item->flavor) }}
          @endisset
          @isset($order_item->cflavor)
              {{ ($order_item->cflavor) }}
          @endisset
        </td>

      <td class="fw-bold" scope="col">{{ $order_item->qty }}</td>

      
      <td class="fw-bold" scope="col">{{ $rate  }}</td>
      <td class="fw-bold" scope="col">{{ $order_item->vat }}</td>
      <td class="fw-bold" scope="col">{{ ($rate * $order_item->qty) + $order_item->vat  }}</td>

    </tr>


@endforeach




    <tr>
    
      <td class="fw-bold" colspan="2" scope="col"></th>
              <td class="fw-bold" colspan="2" class="text-start" scope="col"> Total amount (Wihout Vat) </td>
              <td class="fw-bold"  class="text-end" scope="col"> {{ $order->total_rate }} </td>
  
    </tr>
    <tr>
    
      <td class="fw-bold" colspan="2" scope="col"></th>
              <td class="fw-bold" colspan="2" class="text-start" scope="col"> Vat </td>
              <td class="fw-bold"  class="text-end" scope="col"> {{ $order->total_vat }} </td>
  
    </tr>
    <tr>
    
      <td class="fw-bold" colspan="2" scope="col"></th>
              <td class="fw-bold" colspan="2" class="text-start" scope="col"> Discount </td>
              <td class="fw-bold"  class="text-end" scope="col"> {{ $order->total_discount }} </td>
  
    </tr>




    <tr>
    
      <td class="fw-bold" colspan="2" scope="col"></th>


              <td class="fw-bold" colspan="2" class="text-start" scope="col"> 


                @php
                    $total_adds = 0;
                @endphp
                
                Add_Ones:<br>

                @isset($order->order_add_ons)
                    
                
                @foreach ($order->order_add_ons as $add_one)
            
                @php
                $total_adds += $add_one->price;
               @endphp
            
                  
                  ({{$add_one->name}} - {{$add_one->price}}) 
                  
                @endforeach
                @endisset
              </td>


              <td class="fw-bold"  class="text-end" scope="col"> {{ $total_adds }}  </td>
  
    </tr>





    <tr>
    
      <td class="fw-bold" colspan="2" scope="col"></th>
              <td class="fw-bold" colspan="2" class="text-start" scope="col"> Total </td>
              <td class="fw-bold"  class="text-end" scope="col"> {{ $order->total_with_discount + $total_adds }} </td>
  
    </tr>




 
</table>

</div>
</div>
</div>

<script>
  //     $(function() {
  //   $("#voucher_invoice").find('.print').on('click', function() {
  //     $.print("#voucher_invoice");
  //   });
  
  // });
  
      $(function() {
    $(".print").on('click', function() {
      $.print("#voucher_invoice");
    });
  
  });
  
  </script>

@endsection