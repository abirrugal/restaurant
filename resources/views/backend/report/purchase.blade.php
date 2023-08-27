@extends('backend.layout.master')
@section('main_content')
    
<div class="px-10">


<form action="{{route('admin.purchase_info_filter')}}" method="POST">
@csrf


    
    <div class="row mt-4">

     

        
    <div class="col">
    <div class="mb-3">
     <label for="start_date" class="form-label text-black h6">From Date</label> 
    <input type="date" name="start_date" class="form-control" aria-describedby="PriceHelp" placeholder="From Date">
    
    </div>

    </div>
    <div class="col">
    <div class="mb-3">
     <label for="end_date" class="form-label text-black h6">To Date</label> 
    <input type="date" name="end_date"  class="form-control"  aria-describedby="PriceHelp" placeholder="To Date">
    
    </div>
    </div>




  </div>

    
    
    </div>
    
    <div class="d-flex justify-content-center my-3">
    <button type="submit" class="btn btn-success px-5 py-2"><i class="fas fa-search"></i> Search</button>

</form>

</div>
</div>






<div class=" p-4 " style="background: #fff; border-radius: 15px; -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82); 
box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82);">



<table class="table table-bordered rounded">
  <thead class="rounded">
    <tr class="text-center rounded table_title_color">
      <th scope="col"><i class="far fa-list-alt"></i></th>
      <th scope="col">Date</th>
      <th scope="col">Factory</th>
      <th scope="col">Supplier</th>
      <th scope="col">Supplier Address</th>
      <th scope="col">Grand</th>
      <th scope="col">Discount</th>
      <th scope="col">Total Amount</th>
      <th scope="col">Paid</th>
      <th scope="col">Due</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php
    $i=1;
@endphp

@foreach ($today_purchase as $info)
    

    <tr>
      <th class="text-center">{{$i++}}</th>
      <th class="text-center">{{ \Carbon\Carbon::parse($info->date)->format('d/m/Y')}}</th>
     
      <th class="text-center">{{$info->supplier_company}}</th>
      <th class="text-center">{{$info->supplier_name}}</th>
     <th class="text-center">{{$info->supplier_address}}</th>
     <th class="text-center">{{$info->total_rate}}</th>
     <th class="text-center">{{$info->total_discount}}</th>
     <th class="text-center">{{$info->total_with_discount}}</th>
     <th class="text-center">{{$info->total_payment}}</th>
     <th class="text-center">{{ ($info->total_with_discount - $info->total_payment) }}</th>



     <th class="text-center"> <button class="btn btn-info"><a class="text-white" href="{{ route('admin.purchase_details', $info->id) }}"><i class="fas fa-eye"></i></a></button>  

     <button class="btn btn-danger"><a class="text-white" href="{{ route('admin.purchase.delete', $info->id) }}">X</a></button>  
    </th>


    </tr>

  
    @endforeach

  
  </tbody>
</table>
<div class="d-flex justify-content-end  py-2 rounded">
  {{$today_purchase->links()}} 

   </div>
</div>




@endsection