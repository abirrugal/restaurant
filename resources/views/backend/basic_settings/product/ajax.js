$(document).ready(function() {
    $('.js-example-basic-single').select2({
       dropdownParent: $('#staticBackdrop'),
       
    });
    $('.edit12').select2({
       dropdownParent: $('#edit'),
       
    });
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



