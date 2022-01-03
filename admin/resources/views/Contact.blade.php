@extends('layout.app')
@section('title','Contact')
@section('content')


<div id="mainDiv" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
  
        <table id="contactTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">Name</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Message</th>
              <th class="th-sm">Delete</th>
            </tr>
          </thead>
          <tbody id="contact_table">
  
          </tbody>
  
        </table>
  
      </div>
    </div>
  </div>
  
  <div id="loadDiv" class="container">
    <div class="row">
      <div class="col-md-12 text-center p-5">
       <img class="loading-icon" src="{{asset('images/loader.gif')}}">
  
      </div>
    </div>
  </div>
  
  <div id="errDiv" class="container d-none">
    <div class="row">
      <div class="col-md-12 p-5">
       <h3>Data Not Found. Something went wrong</h3>
  
      </div>
    </div>
  </div>  
  
  <!-- Modal For Delete -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        
        <div class="modal-body text-center">
          <h6>Are You Sure about Delete ?</h6>
          <h5 id="contactDeleteId" class="mt-4"></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="contactDelConfirmBtn" type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

@endsection



@section('script')
<script type="text/javascript">
    getContactData();

    
//Get Contact Data
function getContactData(){

axios.get('/contactget')
.then(function (response) {

if(response.status == 200){

  $('#mainDiv').removeClass('d-none');
  $('#loadDiv').addClass('d-none');

  $('#contactTableId').DataTable().destroy();
  $('#contact_table').empty();

  var dataJSON=response.data;
  $.each(dataJSON, function(i, item) {
  $('<tr>').html(
      "<td>" + dataJSON[i].contact_name + "</td>" +
      "<td>" + dataJSON[i].contact_email + "</td>" +
      "<td>" + dataJSON[i].contact_message + "</td>" +
      "<td><a class='contactDeleteBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-trash-alt'></i></a></td>"
      ).appendTo('#contact_table');
});


  //Delete Icon
  $('.contactDeleteBtn').click(function(){
    var id = $(this).data('id');
    $('#contactDeleteId').html(id);
    $('#deleteModal').modal('show');
  })

  
  $('#contactTableId').DataTable();
  $('.dataTables_length').addClass('bs-select');


}else{
  $('#errDiv').removeClass('d-none');
  $('#loaderDiv').addClass('d-none');
}

}).catch(function (error) {
  $('#errDiv').removeClass('d-none');
  $('#loaderDiv').addClass('d-none');
});

}


//Confirm Delete
  $('#contactDelConfirmBtn').click(function(){
    var id = $('#contactDeleteId').html();
    contactDelete(id);
  })

// Method for Confirm Delete Data
function contactDelete(delid){
//Animation
$('#contactDelConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

axios.post('/contactDelete',{id:delid})
.then(function(response){
$('#contactDelConfirmBtn').html("Delete");
if (response.data ==1) {
  $('#deleteModal').modal('hide');
  toastr.success('Delete Successfully');
  getContactData();
}else{
  $('#deleteModal').modal('hide');
  toastr.error('Error in Delete');
  getContactData();
}
})
.catch(function(error){

});
}

</script>

@endsection