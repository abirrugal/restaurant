<!DOCTYPE html>
<html>
 <head>
  <title>Laravel Pagination using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Laravel Pagination using Ajax</h3><br />
   <div id="table_data">
  


    <div class="table-responsive">
        <table class="table table-striped table-bordered">
         <tr>
          <th width="5%">ID</th>
          <th width="38%">Name</th>
          <th width="57%">Status</th>
         </tr>
         @foreach($data as $row)
         <tr>
          <td>{{$row->id}}</td>
          <td>{{$row->name}}</td>
          <td>{{$row->status}}</td>
         </tr>
         @endforeach
        </table>
    
        {!! $data->links() !!}
    
       </div>






   </div>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {
  $.ajax({
   url:"{{asset('/')}}pagination/fetch_data?page="+page,
   success:function(data)
   {
    $('#table_data').html(data);
   }
  });
 }
 
});
</script>