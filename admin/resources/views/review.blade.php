@extends('layout.app')
@section('title','Review')
@section('content')

<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

      <button id="adNewReviewId" class="btn btn-primary my-3">Add New</button>


      <table id="reviewTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Image</th>
            <th class="th-sm">Name</th>
            <th class="th-sm">Description</th>
            <th class="th-sm">Edit</th>
            <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="review_table">

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

<!-- Modal For Add Review -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <p class="h4 mb-4">Add New Review</p>
        <div id="reviewAddform">
          <input id="reviewAdd_nameId" type="text" id="" class="form-control mb-4" placeholder="Enter reviewer Name">
          <input id="reviewAdd_desId" type="text" id="" class="form-control mb-4" placeholder="Enter review Description">
          <input id="reviewAdd_imgId" type="text" id="" class="form-control mb-4"  placeholder="Enter review Name" >
        </div>        

          <img id="revAddLoader" class="loading-icon d-none" src="{{asset('images/loader.gif')}}">
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="revAddBtn" type="button" class="btn btn-success">Add</button>
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
        <p class="h4 mb-4">Update Review</p>
        <div id="reviewEditform">
          <h5 id="reviewEditId" class="mt-4"></h5>
          <input id="review_nameId" type="text" id="" class="form-control mb-4" >
          <input id="review_desId" type="text" id="" class="form-control mb-4" >
          <input id="review_imgId" type="text" id="" class="form-control mb-4"   >
        </div>        

          <img id="revEditLoader" class="loading-icon d-none" src="{{asset('images/loader.gif')}}">
          <p id="revWrong" class="d-none">Data Not Found. Something went wrong</p>
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="reviewUpdateBtn" type="button" class="btn btn-danger">Update</button>
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
        <h5 id="reviewDeleteId" class="mt-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="reviewDelConfirmBtn" type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
  getReviewData();


  //Get Review Data
function getReviewData(){
  axios.get('/reviewget')
  .then(function (response) {

    if(response.status == 200){

      $('#mainDiv').removeClass('d-none');
      $('#loadDiv').addClass('d-none');

      $('#reviewTableId').DataTable().destroy();
      $('#review_table').empty();

      var dataJSON=response.data;
      $.each(dataJSON, function(i, item) {
      $('<tr>').html(
          "<td><img class='table-img' src="+dataJSON[i].img +"></td>"+
          "<td>" + dataJSON[i].name + "</td>" +
          "<td>" + dataJSON[i].des + "</td>" +
          "<td><a class='reviewEditBtn' data-id="+dataJSON[i].id+"><i class='fas fa-edit'></i></a></td>" +
          "<td><a class='reviewDeleteBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#review_table');
    });


      //Delete Icon
      $('.reviewDeleteBtn').click(function(){
        var id = $(this).data('id');
        $('#reviewDeleteId').html(id);
        $('#deleteModal').modal('show');
      })

      

      //Edit Icon
      $('.reviewEditBtn').click(function(){
        var id = $(this).data('id');

        $('#reviewEditId').html(id);
        reviewUpdate(id);
        $('#editModal').modal('show');
      })

      
      $('#reviewTableId').DataTable();
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
$('#reviewDelConfirmBtn').click(function(){
        var id = $('#reviewDeleteId').html();
        reviewDelete(id);
      })

// Method for Confirm Delete Data
function reviewDelete(delid){
//Animation
  $('#reviewDelConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

  axios.post('/reviewdelete',{id:delid})
  .then(function(response){
    $('#reviewDelConfirmBtn').html("Delete");
    if (response.data ==1) {
      $('#deleteModal').modal('hide');
      toastr.success('Delete Successfully');
      getReviewData();
    }else{
      $('#deleteModal').modal('hide');
      toastr.error('Error in Delete');
      getReviewData();
    }
  })
  .catch(function(error){

  });
}

// Method for Edit Icon Click
function reviewUpdate(detailsid){

  axios.post('/reviewDetails',{id:detailsid})
  .then(function(response){
    if(response.status == 200){
      $('#revEditLoader').addClass('d-none');
      $('#reviewEditform').removeClass('d-none');

      var jsonData = response.data; 
      $('#review_nameId').val(jsonData[0].name);
      $('#review_desId').val(jsonData[0].des);
      $('#review_imgId').val(jsonData[0].img);
    }else{
      $('#reviewWrong').removeClass('d-none');
      $('#reviewEditform').addClass('d-none');
    }
  })
  .catch(function(error){
    $('#reviewWrong').removeClass('d-none');
      $('#reviewEditform').addClass('d-none');
  });
}


//Confirm Edit
      $('#reviewUpdateBtn').click(function(){
        var id = $('#reviewEditId').html();
        var name = $('#review_nameId').val();
        var description = $('#review_desId').val();
        var image = $('#review_imgId').val();
        reviewUpdateClick(id,name,description,image);
      })

// Method for Click Update Btn
function reviewUpdateClick(id,name,description,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else {
    $('#reviewUpdateBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/reviewUpdateClick', {
    id:id,
    name:name,
    des:description,
    img:image,

  })
  .then(function(response){
    $('#reviewUpdateBtn').html("Update");
    if (response.data ==1) {
      $('#editModal').modal('hide');
      toastr.success('Update Successfully');
      getReviewData();
    }else{
      $('#editModal').modal('hide');
      toastr.error('Error in Update');
      getReviewData();
    }
  })
  .catch(function(error){
  });
  }

}

//Add New Btn Clik

$('#adNewReviewId').click(function(){
 
  $('#addModal').modal('show');
});

//Confirm Save
      $('#revAddBtn').click(function(){
        var name = $('#reviewAdd_nameId').val();
        var description = $('#reviewAdd_desId').val();
        var image = $('#reviewAdd_imgId').val();
        reviewAddClick(name,description,image);
      })


// Method for Click Add Btn
function reviewAddClick(name,description,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else {
    $('#revAddBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/reviewAdd', {

    name:name,
    des:description,
    img:image,

  })
  .then(function(response){
    $('#revAddBtn').html("Add");
    if (response.data ==1) {
      $('#addModal').modal('hide');
      toastr.success('Save Successfully');
      getReviewData();
      $('#reviewAdd_nameId').val('');
      $('#reviewAdd_desId').val('');
      $('#reviewAdd_imgId').val('');
    }else{
      $('#addModal').modal('hide');
      toastr.error('Error in Save');
      getReviewData();
    }
  })
  .catch(function(error){
  });
  }

}

</script>

@endsection