@extends('backend.layout.master')
@section('main_content')

@if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif






<div class="h5 text-center my-3 ">Pending Order List</div>

<div class=" p-4 " style="background: #fff; border-radius: 15px; -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82); 
box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82);">



<table class="table table-bordered rounded">
  <thead class="rounded">
    <tr class="text-center rounded table_title_color">
      <th scope="col"><i class="far fa-list-alt"></i></th>
      <th scope="col">Token</th>
      <th scope="col">Table No</th>
      <th scope="col">Grand Total</th>
      <th scope="col">Vat</th>
      <th scope="col">Discount</th>
      <th scope="col">Final Amount</th>
      <th scope="col">Send To Kitchen</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php
    $i=1;
    // $total_rate = 0;
    // $total_vat = 0;
    // $total_discount =0;
    // $total_payable =0;




@endphp


{{-- Calculate Addones Price  --}}







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
      <th class="text-center">{{$info->token}}</th>
      <th class="text-center">{{$info->table_no}}</th>

 

      <th class="text-center">{{$info->total_rate + $total_adds}}</th>
      <th class="text-center">{{$info->total_vat}}</th>
      <th class="text-center">{{$info->total_discount}}</th>
      <th class="text-center">{{$info->total + $total_adds}}</th>
     

                 
      @if (auth()->user()->role_as === 'superadmin')
      <td>


          <form class="d-flex" action="{{route('admin.kitchen.send_kitchen')}}" method="POST" >
              @csrf
          
        
              <input class="w-50" type="hidden" name="order_id" value="{{$info->id}}">
                  <select class="form-select" name="kitchen_id" id="">
                      @foreach ($kitchen_list as $item)

                      <option value='{{$item->id}}'>{{$item->name}}</option>
               
                      @endforeach
                                                      
                  </select>

                  <button type="submit" class="btn btn-sm  btn-success mx-2">Send</button>
          </form>

          
       </td>

      @endif

  
      <td>

        <div class="d-flex flex-wrap justify-content-center">


 
   {{-- Model For Edit  --}}

<!-- Button trigger modal -->




{{-- <button type="button"  class="btn btn-success m-1" 
>
<a class="text-white" href="{{route('admin.order.panding.check', $info->id)}}">
  <i class="fab fa-free-code-camp"></i>
 </a>
</button> --}}


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

@endsection