@extends('backend.layout.master')
@section('main_content')

@if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif


                       {{-- Model For Create / New  --}}

<!-- Button trigger modal -->
<button type="button" class="btn mb-3 ms-4 action_button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
>
  <i class="fa fa-edit"> </i> Create a Factory
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="staticBackdropLabel"><i class="fa fa-edit"> </i> Create New Factory</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.factory.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          
<div class="form-row mt-4">


  <div class="col">
    <div class="mb-3">
      <label for="number" class="form-label text-black h6">Factory Name</label>  
      <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" aria-describedby="PriceHelp" placeholder="Factory Name" required>
      
    </div>
    </div>


<div class="form-floating">
    <textarea class="form-control" name="address" placeholder="Product Details" id="address" style="height: 100px"></textarea>
    <label for="floatingTextarea2">Factory Address</label>
  </div>
  


  <div class="col">
    <div class="mb-3">
      <label for="number" class="form-label text-black h6">Balance</label>  
      <input type="number" name="balance" value="{{old('balance')}}" class="form-control" id="number" aria-describedby="PriceHelp" placeholder="Factory balance" required>
      
    </div>
    </div>








  <div class="mb-3">
  <label for="slider_image" class="form-label text-black h6">Status</label>
  <select class="form-select custom-select" aria-label="Default select example" name="status" id="status" required>
  
    <option value="Active" {{old('active')=== 'active'? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{old('inactive')=== 'inactive'? 'selected' : '' }}>Inactive</option>
   
  </select>
</div>



</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Factory</button>
      </div>
 </form>
      </div>




    </div>
  </div>
</div>







                    

<div class=" p-4 " style="background: #fff; border-radius: 15px; -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82); 
box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.82);">



<table class="table table-bordered rounded">
  <thead class="rounded">
    <tr class="text-center rounded table_title_color">
      <th scope="col"><i class="far fa-list-alt"></i></th>
      <th scope="col"> Name</th>
      <th scope="col">Address</th>
      <th scope="col">Balance</th>
      <th scope="col">Status</th>
      <th scope="col">Change</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php
    $i=1;
@endphp

@foreach ($infos as $info)
    

    <tr>
      <th class="text-center">{{$i++}}</th>
      <th class="text-center">{{$info->name}}</th>
      <th class="text-center">{{$info->address}}</th>
      <th class="text-center">{{$info->balance}}</th>
      <td class="text-center">
@if ($info->status === 'Active')
<span class="badge bg-success"> {{$info->status}} </span>
@endif

@if ($info->status === 'Inactive')
<span class="badge bg-danger"> {{$info->status}} </span>
@endif


      </td>
      <td class="text-center">
        <a class="text-center" href="{{route('admin.factory.change_sts', $info->id)}}"><i class="fas fa-exchange-alt d-block"></i></a>
      </td>
      <td>

        <div class="d-flex flex-wrap justify-content-center">


 
   {{-- Model For Edit  --}}

<!-- Button trigger modal -->




<button type="button" onclick="editdata({{$info->id}})" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#edit" 
>
<i class="far fa-edit"></i> 
</button>


<!-- Modal -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="editLabel"><i class="fa fa-edit"> </i> Edit Factory</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.factory.update', $info->id)}}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          
<div class="form-row mt-4">



    <div class="col">
        <div class="mb-3">
          <label for="number" class="form-label text-black h6">Factory Name</label>  
          <input type="text" name="name" value="{{old('name')}}" class="form-control" id="ename" aria-describedby="PriceHelp" placeholder="Factory Name" required>
          
        </div>
        </div>
    

    
    <div class="form-floating">
        <textarea class="form-control" name="address" placeholder="Product Details" id="eaddress" style="height: 100px"></textarea>
        <label for="floatingTextarea2">Factory Address</label>
      </div>
      
    
    
      <div class="col">
        <div class="mb-3">
          <label for="number" class="form-label text-black h6">Balance</label>  
          <input type="number" name="balance" value="{{old('balance')}}" class="form-control" id="ebalance" aria-describedby="PriceHelp" placeholder="Factory balance" required>
          
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
        <button type="button" class="btn btn-primary" onclick="updatedata()">Edit Factory</button>
      </div>
 </form>
      </div>




    </div>
  </div>
</div>




 {{-- Delete  --}}

         
@if (auth()->user()->role_as !== 'creator')

         <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.factory.delete', $info->id)}}" method="POST">
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
  {{$infos->links()}} 

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
        url: "{{asset('/')}}admin/factory/edit/"+id,
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
        url: "{{asset('/')}}admin/factory/"+id,
        success:function(response){
          
          $('#edit').modal('toggle');
          location.reload();
          category()
        }
      })
  
  
  
  }
  </script>

@endsection