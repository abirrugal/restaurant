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
<button type="button" class="btn mb-3 ms-4 action_button"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
>
  <i class="fa fa-edit"> </i> Create a Add_ons
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="staticBackdropLabel"><i class="fa fa-edit"> </i> Create New Add_ons</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.add_ons.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          
<div class="form-row mt-4">

<div class="col">
<div class="mb-3">
  <label for="number" class="form-label text-black h6">Add_ons Name</label>  
  <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" aria-describedby="PriceHelp" placeholder="Add_ons Name" required>
  
</div>
</div>



<div class="col">
  <div class="mb-3">
     <label for="name" class="form-label text-black h6">Add_ons Price</label>  
    <input type="number" name="price" value="{{old('price')}}" class="form-control" id="slider_image" aria-describedby="PriceHelp" placeholder="Add_ons price" required>
    
  </div>
  </div>


  <div class="mb-3">
  <label for="slider_image" class="form-label text-black h6">Status</label>
  <select class="form-select custom-select" aria-label="Default select example" name="status" id="stock_status" required>
  
    <option value="Active" {{old('active')=== 'active'? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{old('inactive')=== 'inactive'? 'selected' : '' }}>Inactive</option>
   
  </select>
</div>



</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Add_ons</button>
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
      <th scope="col">Add_ons Name</th>
      <th scope="col">Add_ons Price</th>
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
      <th class="text-center">{{$info->price}}</th>
      <td class="text-center">
@if ($info->status === 'Active')
<span class="badge bg-success"> {{$info->status}} </span>
@endif

@if ($info->status === 'Inactive')
<span class="badge bg-danger"> {{$info->status}} </span>
@endif


      </td>



      
      <td class="text-center">
        <a class="text-center" href="{{route('admin.add_ons.change_sts', $info->id)}}"><i class="fas fa-exchange-alt d-block"></i></a>
      </td>
      <td>

        <div class="d-flex flex-wrap justify-content-center">


 
   {{-- Model For Edit  --}}

<!-- Button trigger modal -->




<button type="button" class="btn btn-primary m-1" onclick="editdata({{$info->id}})" data-bs-toggle="modal" data-bs-target="#edit" 
>
<i class="far fa-edit"></i> 
</button>


<!-- Modal -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="editLabel"><i class="fa fa-edit"> </i> Edit Add_ons</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.add_ons.update', $info->id)}}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          
<div class="form-row mt-4">

<div class="col">
<div class="mb-3">
  <label for="number" class="form-label text-black h6 text-left">Add_ons Name</label>  
  <input type="text" name="name" value="{{$info->name}}" class="form-control" id="ename" aria-describedby="PriceHelp" placeholder="Add_ons Name">
  
</div>
</div>


<div class="col">
  <div class="mb-3">
    <label for="number" class="form-label text-black h6 text-left">Add_ons Price</label>  
    <input type="number" name="price" value="{{$info->price}}" class="form-control" id="eprice" aria-describedby="PriceHelp" placeholder="Add_ons Price">
    
  </div>
  </div>

<input type="hidden" id="id">

  <div class="mb-3">
  <label for="slider_image" class="form-label text-black h6">Status</label>
  <select class="form-select custom-select" aria-label="Default select example" name="status" id="estatus" >
    <option>Select Status</option>
    <option value="Active" {{$info->status === 'Active'? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{$info->status === 'Inactive'? 'selected' : '' }}>Inactive</option>
   
  </select>
</div>



</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updatedata()">Edit Add_ons</button>
      </div>
 </form>
      </div>




    </div>
  </div>
</div>




 {{-- Delete  --}}

         
@if (auth()->user()->role_as !== 'creator')

         <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.add_ons.delete', $info->id)}}" method="POST">
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
      url: "{{asset('/')}}admin/add_ons/edit/"+id,
      success:function(response){
      
  

     $('#ename').val(response.name);
    $('#eprice').val(response.price);
    $('#estatus').val(response.status);
    $('#id').val(response.id);

       

        
      }
    })
}




function updatedata(){


  var name = $('#ename').val();

   var price =  $('#eprice').val();
   var status = $('#estatus').val();
    var id = $('#id').val();

    console.log(id);

  $.ajax({
      type:'PUT',
      dataType: 'json',
      data :{
        name:name,
        price:price,
        status:status,
        id:id
      },
      url: "{{asset('/')}}admin/add_ons/"+id,
      success:function(response){
        
        $('#edit').modal('toggle');
        location.reload();
        category()
      }
    })



}
</script>

@endsection