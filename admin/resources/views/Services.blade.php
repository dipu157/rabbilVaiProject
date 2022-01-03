@extends('layout.app')

@section('content')


<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

      <button id="adNewServiceId" class="btn btn-primary my-3">Add New</button>


      <table id="serviceTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Image</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Description</th>
            <th class="th-sm">Edit</th>
            <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="service_table">

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

<!-- Modal For Add Service -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <p class="h4 mb-4">Add New Service</p>
        <div id="serviceAddform">
          <input id="serviceAdd_nameId" type="text" id="" class="form-control mb-4" placeholder="Enter Service Name">
          <input id="serviceAdd_desId" type="text" id="" class="form-control mb-4" placeholder="Enter Service Description">
          <input id="serviceAdd_imgId" type="text" id="" class="form-control mb-4"  placeholder="Enter Service Name" >
        </div>        

          <img id="serAddLoader" class="loading-icon d-none" src="{{asset('images/loader.gif')}}">
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="serviceAddBtn" type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal For Update -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <p class="h4 mb-4">Update Service</p>
        <div id="serviceEditform">
          <h5 id="serviceEditId" class="mt-4"></h5>
          <input id="service_nameId" type="text" id="" class="form-control mb-4" >
          <input id="service_desId" type="text" id="" class="form-control mb-4" >
          <input id="service_imgId" type="text" id="" class="form-control mb-4"   >
        </div>        

          <img id="serEditLoader" class="loading-icon d-none" src="{{asset('images/loader.gif')}}">
          <p id="serviceWrong" class="d-none">Data Not Found. Something went wrong</p>
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="serviceUpdateBtn" type="button" class="btn btn-danger">Update</button>
      </div>
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
        <h5 id="serviceDeleteId" class="mt-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="serviceDelConfirmBtn" type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  getServiceData();

//Get Service Data
function getServiceData(){

    axios.get('/serviceget')
  .then(function (response) {

    if(response.status == 200){

      $('#mainDiv').removeClass('d-none');
      $('#loadDiv').addClass('d-none');

      $('#serviceTableId').DataTable().destroy();
      $('#service_table').empty();

      var dataJSON=response.data;
      $.each(dataJSON, function(i, item) {
      $('<tr>').html(
          "<td><img class='table-img' src="+dataJSON[i].service_img +"></td>"+
          "<td>" + dataJSON[i].service_name + "</td>" +
          "<td>" + dataJSON[i].service_des + "</td>" +
          "<td><a class='serviceEditBtn' data-id="+dataJSON[i].id+"><i class='fas fa-edit'></i></a></td>" +
          "<td><a class='serviceDeleteBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#service_table');
    });


      //Delete Icon
      $('.serviceDeleteBtn').click(function(){
        var id = $(this).data('id');
        $('#serviceDeleteId').html(id);
        $('#deleteModal').modal('show');
      })

      

      //Edit Icon
      $('.serviceEditBtn').click(function(){
        var id = $(this).data('id');

        $('#serviceEditId').html(id);
        serviceUpdate(id);
        $('#editModal').modal('show');
      })

      
      $('#serviceTableId').DataTable();
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
      $('#serviceDelConfirmBtn').click(function(){
        var id = $('#serviceDeleteId').html();
        serviceDelete(id);
      })

// Method for Confirm Delete Data
function serviceDelete(delid){
//Animation
  $('#serviceDelConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

  axios.post('/servicedelete',{id:delid})
  .then(function(response){
    $('#serviceDelConfirmBtn').html("Delete");
    if (response.data ==1) {
      $('#deleteModal').modal('hide');
      toastr.success('Delete Successfully');
      getServiceData();
    }else{
      $('#deleteModal').modal('hide');
      toastr.error('Error in Delete');
      getServiceData();
    }
  })
  .catch(function(error){

  });
}

// Method for Edit Icon Click
function serviceUpdate(detailsid){

  axios.post('/serviceDetails',{id:detailsid})
  .then(function(response){
    if(response.status == 200){
      $('#serEditLoader').addClass('d-none');
      $('#serviceEditform').removeClass('d-none');

      var jsonData = response.data; 
      $('#service_nameId').val(jsonData[0].service_name);
      $('#service_desId').val(jsonData[0].service_des);
      $('#service_imgId').val(jsonData[0].service_img);
    }else{
      $('#serviceWrong').removeClass('d-none');
      $('#serviceEditform').addClass('d-none');
    }
  })
  .catch(function(error){
    $('#serviceWrong').removeClass('d-none');
      $('#serviceEditform').addClass('d-none');
  });
}


//Confirm Edit
      $('#serviceUpdateBtn').click(function(){
        var id = $('#serviceEditId').html();
        var name = $('#service_nameId').val();
        var description = $('#service_desId').val();
        var image = $('#service_imgId').val();
        serviceUpdateClick(id,name,description,image);
      })

// Method for Click Update Btn
function serviceUpdateClick(id,name,description,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else {
    $('#serviceUpdateBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/serviceUpdateClick', {
    id:id,
    service_name:name,
    service_des:description,
    service_img:image,

  })
  .then(function(response){
    $('#serviceUpdateBtn').html("Update");
    if (response.data ==1) {
      $('#editModal').modal('hide');
      toastr.success('Update Successfully');
      getServiceData();
    }else{
      $('#editModal').modal('hide');
      toastr.error('Error in Update');
      getServiceData();
    }
  })
  .catch(function(error){
  });
  }

}

//Add New Btn Clik

$('#adNewServiceId').click(function(){
 
  $('#addModal').modal('show');
});

//Confirm Save
      $('#serviceAddBtn').click(function(){
        var name = $('#serviceAdd_nameId').val();
        var description = $('#serviceAdd_desId').val();
        var image = $('#serviceAdd_imgId').val();
        serviceAddClick(name,description,image);
      })


// Method for Click Add Btn
function serviceAddClick(name,description,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else {
    $('#serviceAddBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/serviceAdd', {

    service_name:name,
    service_des:description,
    service_img:image,

  })
  .then(function(response){
    $('#serviceAddBtn').html("Add");
    if (response.data ==1) {
      $('#addModal').modal('hide');
      toastr.success('Save Successfully');
      getServiceData();
      $('#serviceAdd_nameId').val('');
      $('#serviceAdd_desId').val('');
      $('#serviceAdd_imgId').val('');
    }else{
      $('#addModal').modal('hide');
      toastr.error('Error in Save');
      getServiceData();
    }
  })
  .catch(function(error){
  });
  }

}
</script>
@endsection