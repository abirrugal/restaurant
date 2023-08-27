


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})




    alert(Hello);
$.ajax({
    type:"GET",
    dataType: 'json',
    url:"http://localhost/restaurant_management/public/admin/flavor",
    success:function(response){
 
     console.log(response);

}


})


