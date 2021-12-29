@extends('layout.app')
@section('title','Project')
@section('content')

	<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

      <button id="adNewProjectId" class="btn btn-primary my-3">Add New</button>


      <table id="projectTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Image</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Description</th>
            <th class="th-sm">Edit</th>
            <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="project_table">

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
        <p class="h4 mb-4">Add New Project</p>
        <div id="projectAddform">
          <input id="projectAdd_nameId" type="text" id="" class="form-control mb-4" placeholder="Enter Project Name">
          <input id="projectAdd_desId" type="text" id="" class="form-control mb-4" placeholder="Enter Project Description">
          <input id="projectAdd_linkId" type="text" id="" class="form-control mb-4" placeholder="Enter Project Link">
          <input id="projectAdd_imgId" type="text" id="" class="form-control mb-4"  placeholder="Enter Project Image" >
        </div>        

          <img id="projectAddLoader" class="loading-icon d-none" src="{{asset('images/loader.gif')}}">
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="projectAddBtn" type="button" class="btn btn-success">Add</button>
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
        <p class="h4 mb-4">Update Project</p>
        <div id="projectEditform">
          <h5 id="projectEditId" class="mt-4"></h5>
          <input id="project_nameId" type="text" id="" class="form-control mb-4" >
          <input id="project_desId" type="text" id="" class="form-control mb-4" >
          <input id="project_linkId" type="text" id="" class="form-control mb-4" >
          <input id="project_imgId" type="text" id="" class="form-control mb-4"   >
        </div>        

          <img id="projectEditLoader" class="loading-icon d-none" src="{{asset('images/loader.gif')}}">
          <p id="projectWrong" class="d-none">Data Not Found. Something went wrong</p>
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="projectUpdateBtn" type="button" class="btn btn-danger">Update</button>
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
        <h5 id="projectDeleteId" class="mt-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="projectDelConfirmBtn" type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
	getProjectData();

	

//Get Service Data
function getProjectData(){

    axios.get('/projectget')
  .then(function (response) {

    if(response.status == 200){

      $('#mainDiv').removeClass('d-none');
      $('#loadDiv').addClass('d-none');

      $('#serviceTableId').DataTable().destroy();
      $('#project_table').empty();

      var dataJSON=response.data;
      $.each(dataJSON, function(i, item) {
      $('<tr>').html(
          "<td><img class='table-img' src="+dataJSON[i].project_img +"></td>"+
          "<td>" + dataJSON[i].project_name + "</td>" +
          "<td>" + dataJSON[i].project_des + "</td>" +
          "<td><a class='projectEditBtn' data-id="+dataJSON[i].id+"><i class='fas fa-edit'></i></a></td>" +
          "<td><a class='projectDeleteBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#project_table');
    });


      //Delete Icon
      $('.projectDeleteBtn').click(function(){
        var id = $(this).data('id');
        $('#projectDeleteId').html(id);
        $('#deleteModal').modal('show');
      })

      

      //Edit Icon
      $('.projectEditBtn').click(function(){
        var id = $(this).data('id');

        $('#projectEditId').html(id);
        projectUpdate(id);
        $('#editModal').modal('show');
      })

      
      $('#projectTableId').DataTable();
      $('.dataTables_length').addClass('bs-select');


    }else{
      $('#errDiv').removeClass('d-none');
      $('#loadDiv').addClass('d-none');
    }

    }).catch(function (error) {
      $('#errDiv').removeClass('d-none');
      $('#loadDiv').addClass('d-none');
    });
    
}


//Confirm Delete
      $('#projectDelConfirmBtn').click(function(){
        var id = $('#projectDeleteId').html();
        projectDelete(id);
      })

// Method for Confirm Delete Data
function projectDelete(delid){
//Animation
  $('#projectDelConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

  axios.post('/projectsdelete',{id:delid})
  .then(function(response){
    $('#projectDelConfirmBtn').html("Delete");
    if (response.data ==1) {
      $('#deleteModal').modal('hide');
      toastr.success('Delete Successfully');
      getProjectData();
    }else{
      $('#deleteModal').modal('hide');
      toastr.error('Error in Delete');
      getProjectData();
    }
  })
  .catch(function(error){

  });
}

// Method for Edit Icon Click
function projectUpdate(detailsid){

  axios.post('/projectsDetails',{id:detailsid})
  .then(function(response){
    if(response.status == 200){
      $('#projectEditLoader').addClass('d-none');
      $('#projectEditform').removeClass('d-none');

      var jsonData = response.data; 
      $('#project_nameId').val(jsonData[0].project_name);
      $('#project_desId').val(jsonData[0].project_des);
      $('#project_linkId').val(jsonData[0].project_link);
      $('#project_imgId').val(jsonData[0].project_img);
    }else{
      $('#projectWrong').removeClass('d-none');
      $('#projectEditLoader').addClass('d-none');
    }
  })
  .catch(function(error){
    $('#projectWrong').removeClass('d-none');
      $('#projectEditLoader').addClass('d-none');
  });
}


//Confirm Edit
      $('#projectUpdateBtn').click(function(){
        var id = $('#projectEditId').html();
        var name = $('#project_nameId').val();
        var description = $('#project_desId').val();
        var link = $('#project_linkId').val();
        var image = $('#project_imgId').val();
        projectUpdateClick(id,name,description,link,image);
      })

// Method for Click Update Btn
function projectUpdateClick(id,name,description,link,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else {
    $('#projectUpdateBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/projectsUpdateClick', {
    id:id,
    project_name:name,
    project_des:description,
    project_link:link,
    project_img:image,

  })
  .then(function(response){
    $('#projectUpdateBtn').html("Update");
    if (response.data ==1) {
      $('#editModal').modal('hide');
      toastr.success('Update Successfully');
      getProjectData();
    }else{
      $('#editModal').modal('hide');
      toastr.error('Error in Update');
      getProjectData();
    }
  })
  .catch(function(error){
  });
  }

}

//Add New Btn Clik

$('#adNewProjectId').click(function(){
 
  $('#addModal').modal('show');
});

//Confirm Save
      $('#projectAddBtn').click(function(){
        var name = $('#projectAdd_nameId').val();
        var description = $('#projectAdd_desId').val();
        var link = $('#projectAdd_linkId').val();
        var image = $('#projectAdd_imgId').val();
        projectAddClick(name,description,link,image);
      })


// Method for Click Add Btn
function projectAddClick(name,description,link,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else {
    $('#projectAddBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    
    axios.post('/projectsAdd', {

    project_name:name,
    project_des:description,
    project_link:link,
    project_img:image,

  })
  .then(function(response){
    $('#projectAddBtn').html("Add");
    if (response.data ==1) {
      $('#addModal').modal('hide');
      toastr.success('Save Successfully');
      getProjectData();
      $('#projectAdd_nameId').val('');
      $('#projectAdd_desId').val('');
      $('#projectAdd_linkId').val('');
      $('#projectAdd_imgId').val('');
    }else{
      $('#addModal').modal('hide');
      toastr.error('Error in Save');
      getProjectData();
    }
  })
  .catch(function(error){
  });
  }

}


</script>
@endsection