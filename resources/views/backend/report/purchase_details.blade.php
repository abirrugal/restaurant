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
<p class="fw-bold">Token No :</p>
{{-- BIN : 123456789 --}}
<p class="fw-bold">Order Type : Regular</p>
<p class="fw-bold mb-3">Served By : Super Admin</p>


<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Raw Material</th>
      <th scope="col">Quantity</th>
      <th scope="col">Rate</th>
      <th scope="col">Subtotal</th>

    </tr>
  </thead>


  @foreach ($order->order_products as $order_item)
      


      <tr>
 
      <td class="fw-bold" scope="col">{{ $order_item->name }}</td>
      <td class="fw-bold" scope="col">{{ $order_item->qty }}</td>
      <td class="fw-bold" scope="col">{{ $order_item->rate  }}</td>
      <td class="fw-bold" scope="col">{{ $order_item->payable }}</td>
  

    </tr>


@endforeach




    <tr>
    
      {{-- <td class="fw-bold" colspan="2" scope="col"></th> --}}
              <td class="fw-bold" colspan="3" class="text-start" scope="col"> Total amount </td>
              <td class="fw-bold"  class="text-end" scope="col"> {{ $order->total_rate }} </td>
  
    </tr>

    <tr>
    
      {{-- <td class="fw-bold" colspan="2" scope="col"></th> --}}
              <td class="fw-bold" colspan="3" class="text-start" scope="col"> Discount </td>
              <td class="fw-bold"  class="text-end" scope="col"> {{ $order->total_discount }} </td>
  
    </tr>

    <tr>
    
      {{-- <td class="fw-bold" colspan="2" scope="col"></th> --}}
              <td class="fw-bold" colspan="3" class="text-start" scope="col"> Total </td>
              <td class="fw-bold"  class="text-end" scope="col"> {{ $order->total_with_discount }} </td>
  
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