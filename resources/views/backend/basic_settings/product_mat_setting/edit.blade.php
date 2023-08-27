@extends('backend.layout.master')
@section('main_content')


@if($errors->any())
@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif

<div class="d-flex justify-content-end">
    <a href="{{route('admin.product_mat_setting')}}">
    
    <button class="btn btn-success">Manage</button>
    </a>
  
</div>

<form action="{{route('admin.product_mat_setting.update', $info->id)}}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
    

    



      <input type="hidden" id="id">
    
    <div class="container ">
<div class="border p-3">
      <div class="col-6">
        <div class="mb-3">
          <div class="form-label text-black h6">Select Product</div>  
      
      <select class="ejs-example-basic-single form-select" name="pro_name" id="epro_name" style="width: 100%;">
        @foreach ($products as $product)
      
        <option value="{{$product->name}}" {{$info->name ===  $product->name ? "selected" : "" }}>{{$product->name}}</option>
      
        @endforeach
      
      </select>
      
        </div>
        </div>

      <div class="d-flex flex-wrap flex-column mt-2">
    
        @foreach ($raw_materials as $item)
         
        <div class="d-flex flex-column me-2">
    
        <div class="form-check">
          <input type="hidden" name="unit[]" id="eunit" value="{{$item->unit}}">
    


        <div class="row">
          <div class="col-3">
              <div class="mb-3">
           
                <input type="text" id="disabledTextInput" value="{{$item->name}}" class="border-0" placeholder="{{$item->name}}" name="mat_name[]">
              </div>
              </div>
        
        
              <div class="col-3">
        
            <div class="mb-3">
             
              <input type="number" name="amount[]" class="form-control {{$item->id}}"  placeholder="{{$item->unit}}" aria-describedby="emailHelp">
            </div>
        </div>
        </div>
    
        @foreach($info->amounts as $amount)
         <input type="hidden" name="ids[]" value="{{$amount->id}}">
         @endforeach
    
    
        </div>
      
        @endforeach
    
      </div>
    </div>
    
    
    
      <div class="mb-3">
        <div class="col-6">
      <label for="slider_image" class="form-label text-black h6">Status</label>
      <select class="form-select custom-select" aria-label="Default select example" name="status" id="stock_status" required>
      
        <option value="Active" {{old('active')=== 'active'? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{old('inactive')=== 'inactive'? 'selected' : '' }}>Inactive</option>
       
      </select>
        </div>
    </div>

    <div class="d-flex justify-content-center py-3">
    <button class="btn btn-info text-white w-50" type="submit">Edit</button>
</div>
</div>
</div>
</form>

@endsection

    @section('before_body')



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>

function get_id(id){
    

    $('.'+id).toggleClass('d-none');
  
      
  
    }


      
        $(document).ready(function() {
          $('.ejs-example-basic-single').select2({
          
             
          });
      });
      
      
      
      </script>

      @endsection