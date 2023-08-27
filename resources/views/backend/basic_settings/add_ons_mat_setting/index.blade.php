@extends('backend.layout.master')
@section('main_content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
  <i class="fa fa-edit"> </i> Create a Add-ons Material Settings
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="staticBackdropLabel"><i class="fa fa-edit"> </i> Create New Add-ons Material Settings</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.add_ons_mat_setting.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          


<div class="col">
  <div class="mb-3">
    <div class="form-label text-black h6">Select Add Ons</div>  

<select class="js-example-basic-single form-select" name="pro_name" style="width: 100%;">
  @foreach ($products as $product)

  <option value="{{$product->name}}">{{$product->name}}</option>

  @endforeach

</select>

  </div>
  </div>

<div class="container border ">
  <div class="d-flex flex-wrap flex-column mt-2">

    @foreach ($raw_materials as $item)
     
    <div class="d-flex flex-column me-2">

      <input type="hidden" name="unit[]" value="{{$item->unit}}">

      {{-- <input class="form-check-input" onclick="get_id('{{$item->id}}')" type="checkbox" name="mat_name[]" value="{{$item->name}}">
      <label class="form-check-label me-2" for="exampleRadios2">
        {{$item->name}}
      </label> --}}

<div class="row">
  <div class="col-4">
      <div class="mb-3">
   
        <input type="text" id="disabledTextInput" value="{{$item->name}}" class="border-0" placeholder="{{$item->name}}" name="mat_name[]">
      </div>
      </div>


      <div class="col-8">

    <div class="mb-3">
     
      <input type="number" name="amount[]" class="form-control {{$item->id}}"  placeholder="{{$item->unit}}" aria-describedby="emailHelp">
    </div>
</div>
</div>

    </div>
  
    @endforeach

  </div>
</div>



  <div class="mb-3">
  <label for="slider_image" class="form-label text-black h6">Status</label>
  <select class="form-select custom-select" aria-label="Default select example" name="status" id="stock_status" required>
  
    <option value="Active" {{old('active')=== 'active'? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{old('inactive')=== 'inactive'? 'selected' : '' }}>Inactive</option>
   
  </select>
</div>






      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Add-ons Material Settings</button>
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
      <th scope="col">Add Ons Name</th>
      <th scope="col">Add Ons Materials</th>
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

      <th class="text-center">
        @foreach ($info->add_amounts as $item)
            <div class="card"> {{$item->material_name." "}}  ( {{$item->amount.' -'}} {{$item->unit}} ) </div>
        @endforeach

      </th>



      <td class="text-center">
@if ($info->status === 'Active')
<span class="badge bg-success"> {{$info->status}} </span>
@endif

@if ($info->status === 'Inactive')
<span class="badge bg-danger"> {{$info->status}} </span>
@endif


      </td>
      <td class="text-center">
        <a class="text-center" href="{{route('admin.add_ons_mat_setting.change_sts', $info->id)}}"><i class="fas fa-exchange-alt d-block"></i></a>
      </td>
      <td>




        <div class="d-flex flex-wrap justify-content-center">
  <a href="{{route('admin.add_ons_mat_setting.edit', $info->id)}}">
<button type="button"  class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#edit" 
>
<i class="far fa-edit"></i> 
</button>
</a>
 
 
 {{-- Delete  --}}

        @if (auth()->user()->role_as !== 'creator')

         <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.add_ons_mat_setting.delete', $info->id)}}" method="POST">
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
  $(document).ready(function() {
    $('.js-example-basic-single').select2({
       dropdownParent: $('#staticBackdrop'),
       
    });
});

  $(document).ready(function() {
    $('.ejs-example-basic-single').select2({
       dropdownParent: $('#edit'),
       
    });
});



</script>

@endsection

@section('before_body')



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




<script>
  
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



  function get_id(id){
    

  $('.'+id).toggleClass('d-none');

    

  }
  
  


  function editdata(id){
    $.ajax({
        type:'get',
        dataType: 'json',
        data :{
          id:id
        },
        url: "{{asset('/')}}admin/add_ons_mat_setting/edit/"+id,
        success:function(response){
        

  
      $('#epro_name').val(response[0].name);
      $('#estatus').val(response[0].status);
      $('#id').val(response[0].id);

      response[1].forEach(element => {

       $('#emat_name').val(element.material_name);
       $('#eamount').val(element.amount);
       $('#eunit').val(element.unit);

      });
      


  
         
  
          
        }
      })
  }
  
  
  
  
  function updatedata(){
  
    
   var name = $('#epro_name').val();
      $('#estatus').val();
      $('#id').val();


      $('#epro_name').val();
      $('#estatus').val();
      $('#id').val();

      response[1].forEach(element => {

       $('#emat_name').val();
       $('#eamount').val();
       $('#eunit').val();

      });

  
      console.log(id);
  
    $.ajax({
        type:'PUT',
        dataType: 'json',
        data :{
          name:name,
          type:type,
          amount:amount,
          details:details,
          status:status,
          id:id
        },
        url: "{{asset('/')}}admin/add_ons_mat_setting/"+id,
        success:function(response){
          
          $('#edit').modal('toggle');
          location.reload();
          category()
        }
      })
  
  
  
  }
  </script>
@endsection