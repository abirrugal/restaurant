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


<form action="{{route('admin.other_income_save_info_filter')}}" method="POST">
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
  <i class="fa fa-edit"> </i> Create a Other Income
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="staticBackdropLabel"><i class="fa fa-edit"> </i> Create New Other Income</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.other_income_save.create')}}" method="post" enctype="multipart/form-data">
          @csrf
          
<div class="form-row mt-4">

    <div class="col">
        <div class="mb-3">
          <div class="form-label text-black h6">Other Income Head</div>  
      
      <select class="type form-select" name="type" style="width: 100%;">
        @foreach ($other_income_head_type as $other_income_save)
      
        <option value="{{$other_income_save->name}}">{{$other_income_save->name}}</option>
      
        @endforeach
      
      </select>
      
        </div>
        </div>



        <div class="col">
            <div class="mb-3">
              <div class="form-label text-black h6">Fund</div>  
          
          <select class="head_type form-select" name="fund" style="width: 100%;">
            @foreach ($fund as $other_income_save)
          
            <option value="{{$other_income_save->name}}">{{$other_income_save->name}}</option>
          
            @endforeach
          
          </select>
          
            </div>
            </div>

    

<div class="col">
  <div class="mb-3">
     <label for="name" class="form-label text-black h6">Other income Amount</label>  
    <input type="number" name="amount" value="{{old('amount')}}" class="form-control" id="slider_image" aria-describedby="PriceHelp" placeholder="Other Incomes amount">
    
  </div>
  </div
  >

<div class="col">
  <div class="mb-3">
     <label for="name" class="form-label text-black h6">Other income Date</label>  
    <input type="date" name="date" value="{{old('date')}}" class="form-control" id="slider_image" aria-describedby="PriceHelp" placeholder="Other Incomes date">
    
  </div>
  </div>

  <div class="form-floating">
    <textarea class="form-control" name="note" placeholder="Other Income note" id="floatingTextarea2" style="height: 100px">{{old('note')}}</textarea>
    <label for="floatingTextarea2">Other Incomes Note</label>
  </div>





</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create Other Income</button>
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
      <th scope="col">Other Income Head</th>
      <th scope="col">Fund</th>
      <th scope="col">Other Income Note</th>
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
     
      <th class="text-center">{{$info->type}}</th>
      <th class="text-center">{{$info->fund}}</th>
      <td class="text-center">{{$info->note}}</td>
      <td class="text-center">{{$info->amount}}</td>

 
      <td>

        <div class="d-flex flex-wrap justify-content-center">


 
   {{-- Model For Edit  --}}

<!-- Button trigger modal -->




<button type="button" class="btn btn-primary m-1"  data-bs-toggle="modal" onclick="editdata({{$info->id}})" data-bs-target="#edit" 
>
<i class="far fa-edit"></i> 
</button>


<!-- Modal -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header action_button text-white">
        <h6 class="modal-title" id="editLabel"><i class="fa fa-edit"> </i> Edit Other Income</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Model Body  -->

      <div class="modal-body">
      
        <form action="{{route('admin.other_income_save.update', $info->id)}}" method="post" enctype="multipart/form-data">
          @method('put')
          @csrf
          
<div class="form-row mt-4">
    <div class="col">
        <div class="mb-3">
          <div class="form-label text-black h6">Other Income Type</div>  
      
      <select class="etype form-select" id="intype"  name="type" style="width: 100%;">
        @foreach ($other_income_head_type as $other_income_save)
      
        <option  value="{{$other_income_save->name}}">{{$other_income_save->name}}</option>
      
        @endforeach
      
      </select>
      
        </div>
        </div>

    <input type="hidden" id="id">
   
            <div class="col">
                <div class="mb-3">
                  <div class="form-label text-black h6">Other Income Fund</div>  
              
              <select class="fund form-select" id="infund" name="fund" style="width: 100%;">
                @foreach ($fund as $other_income_save)
              
                <option value="{{$other_income_save->name}}">{{$other_income_save->name}}</option>
              
                @endforeach
              
              </select>
              
                </div>
                </div>
        
        <div class="col">
          <div class="mb-3">
             <label for="name" class="form-label text-black h6">Amount</label>  
            <input type="number" name="amount" value="{{$info->amount}}" class="form-control" id="f1" aria-describedby="PriceHelp" placeholder="Other Incomes amount">
            
          </div>
          </div>
        
        <div class="col">
          <div class="mb-3">
             <label for="name" class="form-label text-black h6">Date</label>  
            <input type="date" name="date" value="{{$info->date}}" class="form-control" id="f2" aria-describedby="PriceHelp" placeholder="Other Incomes date">
            
          </div>
          </div>
        
          <div class="form-floating">
            <textarea class="form-control" name="note" placeholder="Other Income note" id="f3" style="height: 100px">{{$info->note}}</textarea>
            <label for="floatingTextarea2">Other Incomes Note</label>
          </div>



</div>


      <!-- Model Footer  -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updatedata()">Edit Other Income</button>
      </div>
 </form>
      </div>




    </div>
  </div>
</div>




 {{-- Delete  --}}

         
@if (auth()->user()->role_as !== 'creator')
         <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.other_income_save.delete', $info->id)}}" method="POST">
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



function editdata(id){
  $.ajax({
      type:'get',
      dataType: 'json',
      data :{
        id:id
      },
      url: "{{asset('/')}}admin/other_income_save/edit/"+id,
      success:function(response){
      

     $('#f1').val(response.amount);
    $('#f2').val(response.date);
    $('#f3').val(response.note);
    $('#id').val(response.id);
    $('#intype').val(response.type);
    $('#infund').val(response.fund);
  
       

        
      }
    })
}



function updatedata(){
 var amount = $('#f1').val();
  var date =  $('#f2').val();
  var note =  $('#f3').val();
  var type = $('#intype').val();
  var fund = $('#infund').val();
    var id = $('#id').val();


  $.ajax({
      type:'PUT',
      dataType: 'json',
      data :{
        amount:amount,
        date:date,
        note:note,
        type:type,
        fund:fund,
        id:id
      },
      url: "{{asset('/')}}admin/other_income_save/"+id,
      success:function(response){
        
        $('#edit').modal('toggle');
        location.reload();
        category()
      }
    })

}

</script>
@endsection


@section('before_body')



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection




