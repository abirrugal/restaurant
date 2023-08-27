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
  <i class="fa fa-edit"> </i> Create a Category
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title"><i class="fa fa-edit"> </i> Create New Category</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.category.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          
<div class="form-row mt-4">

<div class="col">
<div class="mb-3">
  <label for="number" class="form-label text-black h6">Category Name</label>  
  <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" aria-describedby="PriceHelp" placeholder="Category Name" required>
  
</div>
</div>



<div class="col">
  <div class="mb-3">
     <label for="name" class="form-label text-black h6">Category Serial</label>  
    <input type="text" name="serial" value="{{old('serial')}}" class="form-control" id="serial" aria-describedby="PriceHelp" placeholder="Category Serial">
    
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
        <button type="button" class="btn btn-primary" onclick="add_flavor()">Create Category</button>
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
      <th scope="col">Category Name</th>
      <th scope="col">Category serial</th>
      <th scope="col">Status</th>
      <th scope="col">Change</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    
  
  </tbody>
</table>
<div class="d-flex justify-content-end  py-2 rounded">
  {{$infos->links()}} 

   </div>
</div>




<!-- Modal -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="editLabel"><i class="fa fa-edit"> </i> Edit Flavor</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
    
          
<div class="form-row mt-4">

<div class="col">
<div class="mb-3">
  <label for="number" class="form-label text-black h6 text-left">Category Name</label>  
  <input type="text" name="name" id="edit_name" class="form-control"  aria-describedby="PriceHelp" placeholder="Flavor Name">
  
</div>
</div>

<input type="hidden" id ="id">


<div class="col">
  <div class="mb-3">
     <label for="name" class="form-label text-black h6">Category Serial</label>  
    <input type="text" name="serial" value="{{old('serial')}}" class="form-control" id="edit_serial" aria-describedby="PriceHelp" placeholder="Category Serial">
    
  </div>
  </div>

  <div class="mb-3">
  <label for="slider_image" class="form-label text-black h6">Status</label>
  <select class="form-select custom-select" aria-label="Default select example" name="edit_status" id="edit_status" >
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
   
  </select>
</div>



</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="updatedata()">Edit Flavor</button>
      </div>

      </div>




    </div>
  </div>
</div>


<script type="text/javascript">

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  category()

  
  function category(){
  
  
  $.ajax({
      type:"GET",
      dataType: 'json',
      url:"{{asset('/')}}admin/category/alldata",
      success:function(response){
   
        var data = "";

       var i = 1;
        $.each(response, function(key, value){
          
         data = data + "<tr>"

            data = data + "<td class='text-center'>"+ i++ +"</td>"
            data = data + "<td class='text-center'>"+  value.name + "</td>"
            data = data + "<td class='text-center'>"+  value.serial + "</td>"

if(value.status === 'Active'){
  data = data + "<td class='text-center'>"+ "<span class='badge bg-success'>"  +value.status + "</span>"+ "</td>"
}else{
  data = data + "<td class='text-center'>"+ "<span class='badge bg-danger'>"  +value.status + "</span>" +"</td>"

}

data = data + "<td class='text-center'>" + "<a class='text-center pointer'  onclick ='changests("+value.id+")'>" + "<i class='fas fa-exchange-alt d-block'></i>" + "</a>" + "</td>"



data = data + "<td class='text-center'>"+ 
"<button type='button' onclick ='deletedata("+value.id+")' class='btn btn-danger m-1'>" + "<i class='far fa-trash-alt'></i>" + "</button>" +
"<button type='button' data-bs-toggle='modal' data-bs-target='#edit' onclick = 'editdata("+value.id+")' class='btn btn-primary m-1'>" + "<i class='far fa-edit'></i> " + "</button>"
+"</td>"

          data = data + "</tr>"

        });

        $('tbody').html(data);


  }
  
  
  })
  }



function editdata(id){
  $.ajax({
      type:'get',
      dataType: 'json',
      data :{
        id:id
      },
      url: "{{asset('/')}}admin/category/edit/"+id,
      success:function(response){
      
        var name = $('#edit_name').val(response.name);
        var serial = $('#editserial').val(response.serial);
        var id = $('#id').val(response.id);

        
      }
    })
}

function updatedata(){
      var status = $('#edit_status').val();
       var name = $('#edit_name').val();
        var serial = $('#edit_serial').val();
        var id = $('#id').val();


  $.ajax({
      type:'put',
      dataType: 'json',
      data :{
        name:name,
        serial:serial,
        status:status,
        id:id
      },
      url: "{{asset('/')}}admin/category/"+id,
      success:function(response){

        $('#edit').modal('toggle');
        category()
      }
    })

}

function deletedata(id){


var del=confirm("Are you sure you want to delete this record?");
if (del==true){

  $.ajax({
      type:'delete',
      dataType: 'json',
      data :{
        id:id
      },
      url: "{{asset('/')}}admin/category/"+id,

      success:function(response){
        category();
        alert ("record deleted")

        
      }
    })


}else{
    alert("Record Not Deleted")
}
return del;


}

  function changests(id){
    $.ajax({
      type:'GET',
      dataType: 'json',
      data :{
        id:id
      },
      url: "{{asset('/')}}admin/category/"+id+"/change_sts",
      success:function(response){
      
        category()
      }
    })
  }
  

  
  function add_flavor(){


    var status = $('#status').val();
       var name = $('#name').val();
        var serial = $('#serial').val();



    $.ajax({
      type:'POST',
      dataType: 'json',
      data :{
        name:name,
        status:status,
        serial: serial
      },
      url: "{{asset('/')}}admin/category/create",
      success:function(response){
  $('#name').val('');
  $('#status').val('');
  $('#serial').val('');

  $('#staticBackdrop').modal('toggle');

        category()
     
      }
    })
  }

  </script>

  <style>
    .pointer{
      cursor: pointer;
    }
  </style>
@endsection