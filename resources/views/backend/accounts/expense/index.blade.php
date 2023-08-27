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


<form action="{{route('admin.expense_info_filter')}}" method="get">
@csrf


    
    <div class="row mt-4">
    
    <div class="col">
    <div class="mb-3">
    {{--  <label for="name" class="form-label text-black h6">Guest Name</label>  --}}
    <input type="date" name="start_date" class="form-control" aria-describedby="PriceHelp" placeholder="From Date">
    
    </div>
    </div>
    <div class="col">
    <div class="mb-3">
    {{--  <label for="name" class="form-label text-black h6">Guest Name</label>  --}}
    <input type="date" name="end_date"  class="form-control"  aria-describedby="PriceHelp" placeholder="To Date">
    
    </div>
    </div>
    
    
    </div>
    
    <div class="d-flex justify-content-center my-3">
    <button type="submit" class="btn btn-success w-50">Submit</button>

</form>

</div>
</div>




                       {{-- Model For Create / New  --}}

<!-- Button trigger modal -->
<button type="button" class="btn mb-3 ms-4 action_button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" 
>
  <i class="fa fa-edit"> </i> Create a Expense
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="staticBackdropLabel"><i class="fa fa-edit"> </i> Create New Expense</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.expense.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          
<div class="form-row mt-4">

    <div class="col">
        <div class="mb-3">
          <div class="form-label text-black h6">Expense Type</div>  
      
      <select class="type form-select" name="type" style="width: 100%;">
        @foreach ($expenses_type as $expense)
      
        <option value="{{$expense->name}}">{{$expense->name}}</option>
      
        @endforeach
      
      </select>
      
        </div>
        </div>



        <div class="col">
            <div class="mb-3">
              <div class="form-label text-black h6">Expense Head Type</div>  
          
          <select class="head_type form-select" name="head_type" style="width: 100%;">
            @foreach ($expenses_head_type as $expense)
          
            <option value="{{$expense->name}}">{{$expense->name}}</option>
          
            @endforeach
          
          </select>
          
            </div>
            </div>

            <div class="col">
                <div class="mb-3">
                  <div class="form-label text-black h6">Expense Fund</div>  
              
              <select class="fund form-select" name="fund" style="width: 100%;">
                @foreach ($expenses_fund as $expense)
              
                <option value="{{$expense->name}}">{{$expense->name}}</option>
              
                @endforeach
              
              </select>
              
                </div>
                </div>

<div class="col">
  <div class="mb-3">
     <label for="name" class="form-label text-black h6">Amount</label>  
    <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="slider_image" aria-describedby="PriceHelp" placeholder="Expenses amount">
    
  </div>
  </div>


  <div class="col">
    <div class="mb-3">
    <label for="name" class="form-label text-black h6">Expense Date</label>
    <input type="date" name="date" value="{{old('date')}}"  class="form-control" id="slider_image" aria-describedby="PriceHelp" placeholder="Date">
    
    </div>
    </div>

  <div class="form-floating">
    <textarea class="form-control" name="note" placeholder="Expense note" id="floatingTextarea2" style="height: 100px">{{old('note')}}</textarea>
    <label for="floatingTextarea2">Expenses Note</label>
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
        <button type="submit" class="btn btn-primary">Create Expense</button>
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
      <th scope="col">Date</th>
      <th scope="col">Expense Head</th>
      <th scope="col">Expense Type</th>
      <th scope="col">Fund</th>
      <th scope="col">Expense Note</th>
      <th scope="col">Amount</th>
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
      <th class="text-center">{{$info->date}}</th>
      <th class="text-center">{{$info->head_type}}</th>
      <th class="text-center">{{$info->type}}</th>
      <th class="text-center">{{$info->fund}}</th>
      <td class="text-center">{{$info->note}}</td>
      <td class="text-center">{{$info->amount}}</td>
   
   
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
        <h6 class="modal-title" id="editLabel"><i class="fa fa-edit"> </i> Edit Expense</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.expense.update', $info->id)}}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          
<div class="form-row mt-4">
    <div class="col">
        <div class="mb-3">
          <div class="form-label text-black h6">Expense Type</div>  
      
      <select class="etype form-select" name="type" id="etype" style="width: 100%;">
        @foreach ($expenses_type as $expense)
      
        <option value="{{$expense->name}}">{{$expense->name}}</option>
      
        @endforeach
      
      </select>
      
        </div>
        </div>



        <div class="col">
            <div class="mb-3">
              <div class="form-label text-black h6">Expense Head Type</div>  
          
          <select class="ehead_type form-select" name="head_type" id="ehead_type" style="width: 100%;">
            @foreach ($expenses_head_type as $expense)
          
            <option value="{{$expense->name}}">{{$expense->name}}</option>
          
            @endforeach
          
          </select>
          
            </div>
            </div>
   
            <div class="col">
                <div class="mb-3">
                  <div class="form-label text-black h6">Expense Fund</div>  
              
              <select class="fund form-select" name="fund" id="efund" style="width: 100%;">
                @foreach ($expenses_fund as $expense)
              
                <option value="{{$expense->name}}">{{$expense->name}}</option>
              
                @endforeach
              
              </select>
              
                </div>
                </div>
        
        <div class="col">
          <div class="mb-3">
             <label for="name" class="form-label text-black h6">Amount</label>  
            <input type="number" name="amount" value="{{$info->amount}}" class="form-control" id="eamount" aria-describedby="PriceHelp" placeholder="Expenses amount">
            
          </div>
          </div>
        
        <div class="col">
          <div class="mb-3">
             <label for="name" class="form-label text-black h6">Date</label>  
            <input type="date" name="date" value="{{$info->date}}" class="form-control" id="edate" aria-describedby="PriceHelp" placeholder="Expenses date">
            
          </div>
          </div>


        
          <div class="form-floating">
            <textarea class="form-control" name="note" placeholder="Expense note" id="enote" style="height: 100px">{{$info->note}}</textarea>
            <label for="floatingTextarea2">Expenses Note</label>
          </div>


  <div class="mb-3">
  <label for="slider_image" class="form-label text-black h6">Status</label>
  <select class="form-select custom-select" aria-label="Default select example" name="status" id="estatus" >
    <option>Select Status</option>
    <option value="Active" {{$info->status === 'Active'? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{$info->status === 'Inactive'? 'selected' : '' }}>Inactive</option>
   
  </select>
</div>

<input type="hidden" id="id">

</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updatedata()">Edit Expense</button>
      </div>
 </form>
      </div>




    </div>
  </div>
</div>




 {{-- Delete  --}}

        @if (auth()->user()->role_as !== 'creator') 

         <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.expense.delete', $info->id)}}" method="POST">
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
      $('.type').select2({
         dropdownParent: $('#staticBackdrop'),
         
      });
  });

    $(document).ready(function() {
      $('.etype').select2({
         dropdownParent: $('#edit'),
         
      });
  });
  
    $(document).ready(function() {
      $('.ehead_type').select2({
         dropdownParent: $('#edit'),
        
      });
      });

    $(document).ready(function() {
      $('.head_type').select2({
         dropdownParent: $('#staticBackdrop'),
        
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
  
  
  function editdata(id){
    $.ajax({
        type:'get',
        dataType: 'json',
        data :{
          id:id
        },
        url: "{{asset('/')}}admin/expense/edit/"+id,
        success:function(response){
        
    

      $('#etype').val(response.type);
      $('#ehead_type').val(response.head_type);
      $('#efund').val(response.fund);
      $('#eamount').val(response.amount);
      $('#edate').val(response.date);
      $('#enote').val(response.note);
      $('#estatus').val(response.status);
      $('#id').val(response.id);
  
        
          
        }
      })
  }
  
  
  
  
  function updatedata(){
  
   var type = $('#etype').val();
   var head_type =  $('#ehead_type').val();
   var fund =   $('#efund').val();
  var amount =  $('#eamount').val();
  var date =   $('#edate').val();
  var note =  $('#enote').val();
  var status =  $('#estatus').val();
  var id =  $('#id').val();
  
     
  
    $.ajax({
        type:'PUT',
        dataType: 'json',
        data :{
          amount:amount,
          type:type,
          head_type:head_type,
          fund:fund,
          date:date,          
          note:note,
          status:status,
          id:id
        },
        url: "{{asset('/')}}admin/expense/"+id,
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

<script type="text/javascript">

  $('#start').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'dd mmm yyyy'
  });

  $('#end').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'dd mmm yyyy'
  });

  </script>
@endsection




