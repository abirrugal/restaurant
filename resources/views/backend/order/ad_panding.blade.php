@extends('backend.layout.master')
@section('main_content')

@if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif




<!-- DATE PICKER  -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
{{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  --}}
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />




    
<div class="px-10">


<form action="{{route('admin.advanced_panding_filter')}}" method="POST">
@csrf


    
    <div class="row mt-4">

     
      <div class="col">
        <div class="mb-3">
         <label for="number" class="form-label text-black h6">Contact number</label> 
        <input type="text" name="number"  class="form-control"  aria-describedby="PriceHelp" placeholder="Contact number">
        
        </div>
        </div>
        
     
    
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



<div class="h5 text-center my-3 ">Waiting Advance Delivery List</div>

{{-- Calculate Addones Price  --}}








<div class=" p-4 " style="background: #fff; border-radius: 15px; -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82); 
box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82);">



<table class="table table-bordered rounded">
  <thead class="rounded">
    <tr class="text-center rounded table_title_color">
      <th scope="col"><i class="far fa-list-alt"></i></th>
      <th scope="col">Delivery date</th>
      <th scope="col">Customer</th>
      <th scope="col">Order note</th>
      <th scope="col">Token</th>
      <th scope="col">Grand total</th>
      <th scope="col">Total Vat</th>
      <th scope="col">Discount</th>
      <th scope="col">Final Amount</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>



    @php
    $i = 1;
    
    
    @endphp



@foreach ($panding_orders as $info)


@php
$total_adds = 0;


@endphp

@foreach ($info->order_add_ons as $item)
@php
$total_adds = $total_adds+$item->price;
@endphp 
@endforeach

    <tr>
      <th class="text-center">{{$i++}}</th>
      <th class="text-center">
        {{ \Carbon\Carbon::parse($info->delivery_date)->format('d/m/Y')}}
        {{-- {{$info->delivery_date}} --}}
      </th>
      <th class="text-center">


          <p>{{$info->customer_name}}</p>

          
          <p class="text-danger">( {{$info->customer_number}} )</p>

        </th>
        <th class="text-center">{{$info->note}}</th>

        <th class="text-center">{{$info->token}}</th>

      <th class="text-center">{{$info->total_rate + $total_adds}}</th>
      <th class="text-center">{{$info->total_vat}}</th>
      <th class="text-center">{{$info->total_discount}}</th>
      <th class="text-center">{{$info->total + $total_adds}}</th>


     
  
      <td>

        <div class="d-flex flex-wrap justify-content-center">


 
   {{-- Model For Edit  --}}

<!-- Button trigger modal -->




<button type="button"  class="btn btn-success m-1" 
>
<a class="text-white" href="{{route('admin.order.panding.check', $info->id)}}">
<i class="fas fa-check"></i>
 </a>
</button>


<!-- Modal -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="editLabel"><i class="fa fa-edit"> </i> Edit Panding Order</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          
<div class="form-row mt-4">



    <div class="col">
        <div class="mb-3">
          <label for="number" class="form-label text-black h6">Panding Order Name</label>  
          <input type="text" name="name" value="{{old('name')}}" class="form-control" id="ename" aria-describedby="PriceHelp" placeholder="Panding Order Name" required>
          
        </div>
        </div>
    

    
    <div class="form-floating">
        <textarea class="form-control" name="address" placeholder="Product Details" id="eaddress" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Panding Order Address</label>
      </div>
      
    
    
      <div class="col">
        <div class="mb-3">
          <label for="number" class="form-label text-black h6">Balance</label>  
          <input type="number" name="balance" value="{{old('balance')}}" class="form-control" id="ebalance" aria-describedby="PriceHelp" placeholder="Panding Order balance" required>
          
        </div>
        </div>
    
    
    
    
    <input type="hidden" id="id">
    
    
    
      <div class="mb-3">
      <label for="slider_image" class="form-label text-black h6">Status</label>
      <select class="form-select custom-select" aria-label="Default select example" name="status" id="estatus" required>
      
        <option value="Active" {{old('active')=== 'active'? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{old('inactive')=== 'inactive'? 'selected' : '' }}>Inactive</option>
       
      </select>
    </div>



</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updatedata()">Edit Panding Order</button>
      </div>
 </form>
      </div>




    </div>
  </div>
</div>




 {{-- Delete  --}}

         
@if (auth()->user()->role_as !== 'creator')

         <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.order.panding.delete', $info->id)}}" method="POST">
          @csrf
          @method('Delete')
          <button type="submit" class="btn btn-danger m-1"><i class="far fa-trash-alt"></i></button>
          </form>
@endif
        </div>

      </td>


  
    </tr>

  
    @endforeach
 
  
  </tbody>
</table>
<div class="d-flex justify-content-end  py-2 rounded">
  {{$panding_orders->links()}} 

   </div>
</div>




<script>
  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  
  function editdata(id){
    $.ajax({
        type:'get',
        dataType: 'json',
        data :{
          id:id
        },
        url: "{{asset('/')}}admin/panding/edit/"+id,
        success:function(response){
        
    
  
 
      $('#ename').val(response.name);
      $('#eaddress').val(response.address);
      $('#ebalance').val(response.balance);
      $('#estatus').val(response.status);
      $('#id').val(response.id);
  
         
  
          
        }
      })
  }
  
  
  
  
  function updatedata(){
  
   var name = $('#ename').val();
      var address = $('#eaddress').val();
      var balance = $('#ebalance').val();
     var status =  $('#estatus').val();
      var id = $('#id').val();
  
     
  
    $.ajax({
        type:'PUT',
        dataType: 'json',
        data :{
            name:name,
            address:address,
            balance:balance,          
            status:status,
            id:id
        },
        url: "{{asset('/')}}admin/panding/"+id,
        success:function(response){
          
          $('#edit').modal('toggle');
          location.reload();
          category()
        }
      })
  
  
  
  }
  </script>

  <style>
    .px-10{
    padding: 3px 150px;
  }
  </style>

@endsection