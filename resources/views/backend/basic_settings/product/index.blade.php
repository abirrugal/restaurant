@extends('backend.layout.master')
@section('main_content')

@if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                       {{-- Model For Create / New  --}}

<!-- Button trigger modal -->
<button type="button" class="btn mb-3 ms-4 action_button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
>
  <i class="fa fa-edit"> </i> Create a Product
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="staticBackdropLabel"><i class="fa fa-edit"> </i> Create New Product</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.product.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          
<div class="form-row mt-4">

<div class="col">
<div class="mb-3">
  <label for="number" class="form-label text-black h6">Serial Number</label>  
  <input type="text" name="serial" value="{{old('serial')}}" class="form-control" id="name" aria-describedby="PriceHelp" placeholder="Product serial" >
  
</div>
</div>

<div class="col">
  <div class="mb-3">
    <div class="form-label text-black h6">Category</div>  

<select class="js-example-basic-single form-select" name="category_id" style="width: 100%;">
  @foreach ($categories as $category)

  <option value="{{$category->id}}">{{$category->name}}</option>

  @endforeach

</select>

  </div>
  </div>



<div class="col">
<div class="mb-3">
  <label for="number" class="form-label text-black h6">Product Name</label>  
  <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" aria-describedby="PriceHelp" placeholder="Product Name" required>
  
</div>
</div>



<div class="form-floating">
  <textarea class="form-control" name="details" placeholder="Product Details" id="floatingTextarea2" style="height: 100px">{{old('details')}}</textarea>
  <label for="floatingTextarea2">Product Details</label>
</div>


<div class="col">
  <div class="mb-3">
    <label for="number" class="form-label text-black h6">Product Image</label>  
    <input type="file" name="image" value="{{old('image')}}" class="form-control" id="image" aria-describedby="PriceHelp" placeholder="Product Image" required>
    
  </div>
  </div>


<div class="container border p-3">
  <div class="form-check form-switch">
    <input class="form-check-input " type="checkbox" id="flexSwitchCheck" name="flavor" value="yes">
    <label class="form-check-label text-dark fw-bold" for="flexSwitchCheckDefault ">flavor</label>
  </div>


  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheck" name="cflavor" value="yes" >
    <label class="form-check-label text-dark fw-bold" for="flexSwitchCheckChecked">Chocolate flavor</label>
  </div>

  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheck" name="add_ons" value="yes" >
    <label class="form-check-label text-dark fw-bold" for="flexSwitchCheckChecked">Add Ons</label>
  </div>
  </div>



  <div class="row mt-3">
    <div class="col">
      <div class="mb-3">
        <label for="number" class="form-label text-black h6">SD Paid</label>  
        <input type="number" name="sd_paid" value="{{old('sd_paid')}}" class="form-control" id="sd_paid" aria-describedby="PriceHelp" placeholder="SD Paid" >
        
      </div>
      </div>

      <div class="col">
        <div class="mb-3">
          <label for="number" class="form-label text-black h6">VAT Paid</label>  
          <input type="number" name="vat" value="{{old('vat')}}" class="form-control" id="vat" aria-describedby="PriceHelp" placeholder="VAT Paid" >
          
        </div>
        </div>

      <div class="col">
        <div class="mb-3">
          <label for="number" class="form-label text-black h6">SD Drinks</label>  
          <input type="number" name="sd_drink" value="{{old('sd_drink')}}" class="form-control" id="sd_drink" aria-describedby="PriceHelp" placeholder="SD Drinks" >
          
        </div>
        </div>
  </div>


  <div class="col">
    <div class="mb-3">
      <label for="number" class="form-label text-black h6">Product Rate</label>  
      <input type="number" name="rate" value="{{old('rate')}}" class="form-control" id="rate" aria-describedby="PriceHelp" placeholder="Product Rate" required>
      
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
        <button type="submit" class="btn btn-primary">Create Product</button>
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
      <th scope="col">Name</th>
      <th scope="col">Details</th>
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
      <th class="text-center">{!!$info->details!!}</th>
      <td class="text-center">
@if ($info->status === 'Active')
<span class="badge bg-success"> {{$info->status}} </span>
@endif

@if ($info->status === 'Inactive')
<span class="badge bg-danger"> {{$info->status}} </span>
@endif


      </td>
      <td class="text-center">
        <a class="text-center" href="{{route('admin.product.change_sts', $info->id)}}"><i class="fas fa-exchange-alt d-block"></i></a>
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
        <h6 class="modal-title" id="editLabel"><i class="fa fa-edit"> </i> Edit Product</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.product.update', $info->id)}}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
           
<div class="form-row mt-4">

  <div class="col">
  <div class="mb-3">
    <label for="number" class="form-label text-black h6">Serial Number</label>  
    <input type="text" name="serial"  class="form-control" id="eserial" aria-describedby="PriceHelp" placeholder="Product serial" >
    
  </div>
  </div>
  
  <div class="col">
    <div class="mb-3">
      <div class="form-label text-black h6">Category</div>  
  
  <select class="edit12 form-select" name="category_id" id="category_id" style="width: 100%;">
    @foreach ($categories as $category)
  
    <option value="{{$category->id}}">{{$category->name}}</option>
  
    @endforeach
  
  </select>
  
    </div>
    </div>
  
    <input type="hidden" id="id">
  
  
  <div class="col">
  <div class="mb-3">
    <label for="number" class="form-label text-black h6">Product Name</label>  
    <input type="text" name="name"  class="form-control" id="ename" aria-describedby="PriceHelp" placeholder="Product Name" required>
    
  </div>
  </div>
  
  
  
  <div class="form-floating">
    <textarea class="form-control" name="details" placeholder="Product Details" id="edetails" style="height: 100px"></textarea>
    <label for="floatingTextarea2">Product Details</label>
  </div>
  
  
  <div class="col">
    <div class="mb-3">
      <label for="number" class="form-label text-black h6">Product Image</label>  
      <input type="file" name="image"  class="form-control" id="image" aria-describedby="PriceHelp" placeholder="Product Image">
      
    </div>
    </div>
  
  
  <div class="container border p-3">
    <div class="form-check form-switch">
      <input class="form-check-input " type="checkbox" id="eflavor" name="flavor" value="yes" 
      @if($info->flavor === "yes") checked @endif
      >
      <label class="form-check-label text-dark fw-bold" for="flexSwitchCheckDefault ">flavor</label>
    </div>
  
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="ecflavor" name="cflavor" value="yes" 
      @if($info->cflavor === "yes") checked @endif
      >
      <label class="form-check-label text-dark fw-bold" for="flexSwitchCheckChecked">Chocolate flavor</label>
    </div>
  
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" id="eadd_ons" name="add_ons" value="yes" 
      @if($info->add_ons === "yes") checked @endif
      >
      <label class="form-check-label text-dark fw-bold" for="flexSwitchCheckChecked">Add Ons</label>
    </div>
    </div>
  
  
  
    <div class="row mt-3">
      <div class="col">
        <div class="mb-3">
          <label for="number" class="form-label text-black h6">SD Paid</label>  
          <input type="number" name="sd_paid" class="form-control" id="esd_paid" aria-describedby="PriceHelp" placeholder="SD Paid" required>
          
        </div>
        </div>
  
        <div class="col">
          <div class="mb-3">
            <label for="number" class="form-label text-black h6">VAT Paid</label>  
            <input type="number" name="vat"  class="form-control" id="evat" aria-describedby="PriceHelp" placeholder="VAT Paid" required>
            
          </div>
          </div>
  
        <div class="col">
          <div class="mb-3">
            <label for="number" class="form-label text-black h6">SD Drinks</label>  
            <input type="number" name="sd_drink"  class="form-control" id="esd_drink" aria-describedby="PriceHelp" placeholder="SD Drinks" required>
            
          </div>
          </div>
    </div>
  
  
    <div class="col">
      <div class="mb-3">
        <label for="number" class="form-label text-black h6">Product Rate</label>  
        <input type="number" name="rate"  class="form-control" id="erate" aria-describedby="PriceHelp" placeholder="Product Rate" required>
        
      </div>
      </div>
  
    <div class="mb-3">
    <label for="slider_image" class="form-label text-black h6">Status</label>
    <select class="form-select custom-select" aria-label="Default select example" name="status" id="estatus" required>
    
      <option value="Active" {{$info->status === 'active'? 'selected' : '' }}>Active</option>
      <option value="Inactive" {{$info->status === 'inactive'? 'selected' : '' }}>Inactive</option>
     
    </select>
  </div>
  
  
  
  </div>
  


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updatedata()">Edit Product</button>
      </div>
 </form>
      </div>




    </div>
  </div>
</div>




 {{-- Delete  --}}

         
@if (auth()->user()->role_as !== 'creator')

         <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.product.delete', $info->id)}}" method="POST">
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
    $('.edit12').select2({
       dropdownParent: $('#edit'),
       
    });
});

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
      url: "{{asset('/')}}admin/product/edit/"+id,
      success:function(response){
      
  

     $('#ename').val(response.name);
    $('#eserial').val(response.serial);
    $('#edetails').val(response.details);
    $('#eflavor').val(response.flavor);
    $('#ecflavor').val(response.cflavor);
    $('#eadd_ons').val(response.add_ons);
    $('#esd_paid').val(response.sd_paid);
    $('#evat').val(response.vat);
    $('#esd_drink').val(response.sd_drink);
    $('#erate').val(response.rate);
    $('#category_id').val(response.category_id);
    $('#estatus').val(response.status);
    $('#id').val(response.id);

       

        
      }
    })
}




function updatedata(){


  var name = $('#ename').val();
    var serial = $('#eserial').val();
   var details = $('#edetails').val();
   var flavor = $('#eflavor').val();
   var cflavor = $('#ecflavor').val();
   var add_ons = $('#eadd_ons').val();
   var sd_paid = $('#esd_paid').val();
    var evat = $('#evat').val();
   var sd_drink = $('#esd_drink').val();
   var rate =  $('#erate').val();
   var category_id = $('#category_id').val();
   var status = $('#estatus').val();
    var id = $('#id').val();

    

  $.ajax({
      type:'PUT',
      dataType: 'json',
      data :{
        name:name,
        serial:serial,
        details:details,
        flavor:flavor,
        cflavor:cflavor,
        add_ons:add_ons,
        sd_paid:sd_paid,
        evat:evat,
        sd_drink:sd_drink,
        rate:rate,
        status:status,
        category_id:category_id,

        id:id
      },
      url: "{{asset('/')}}admin/product/"+id,
      success:function(response){
        
        $('#edit').modal('toggle');
        location.reload();
        category()
      }
    })



}





</script>
@section('before_body')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection
@endsection