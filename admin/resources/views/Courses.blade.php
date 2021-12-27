@extends('layout.app')

@section('content')

<div id="coursemainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
	<button id="adNewCourseId" class="btn btn-primary my-3">Add New</button>
<table id="corseTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Course Fee</th>
	  <th class="th-sm">Total Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Details</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">
		
  </tbody>
</table>

</div>
</div>
</div>

<div id="courseloadDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
     <img class="loading-icon" src="{{asset('images/loader.gif')}}">

    </div>
  </div>
</div>

<div id="courseerrDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">
     <h3>Data Not Found. Something went wrong</h3>

    </div>
  </div>
</div>

<!--  Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!--  Edit Course Modal -->
<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <h5 id="courseEditId" class="mt-4"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameIdU" type="text" id="" class="form-control mb-3">
          	 	<input id="CourseDesIdU" type="text" id="" class="form-control mb-3">
    		 	<input id="CourseFeeIdU" type="text" id="" class="form-control mb-3">
     			<input id="CourseEnrollIdU" type="text" id="" class="form-control mb-3">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassIdU" type="text" id="" class="form-control mb-3">      
     			<input id="CourseLinkIdU" type="text" id="" class="form-control mb-3">
     			<input id="CourseImgIdU" type="text" id="" class="form-control mb-3">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="courseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
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
        <h5 id="courseDeleteId" class="mt-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="courseDelConfirmBtn" type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
	<script type="text/javascript">
	getCourseData();

	
//Get Course Data
function getCourseData(){

    axios.get('/courseget')
  .then(function (response) {

    if(response.status == 200){

      $('#coursemainDiv').removeClass('d-none');
      $('#courseloadDiv').addClass('d-none');

      $('#corseTableId').DataTable().destroy();
      $('#course_table').empty();

      var dataJSON=response.data;
      $.each(dataJSON, function(i, item) {
      $('<tr>').html(
          "<td>" + dataJSON[i].course_name + "</td>" +
          "<td>" + dataJSON[i].course_fee + "</td>" +
          "<td>" + dataJSON[i].course_totalclass + "</td>" +
          "<td>" + dataJSON[i].course_totalenroll + "</td>" +
          "<td><a class='courseViewBtn' data-id="+dataJSON[i].id+"><i class='fas fa-eye'></i></a></td>" +
          "<td><a class='courseEditBtn' data-id="+dataJSON[i].id+"><i class='fas fa-edit'></i></a></td>" +
          "<td><a class='courseDeleteBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#course_table');
    });


      //Delete Icon
      $('.courseDeleteBtn').click(function(){
        var id = $(this).data('id');
        $('#courseDeleteId').html(id);
        $('#deleteModal').modal('show');
      })

    
      //Edit Icon
      $('.courseEditBtn').click(function(){
        var id = $(this).data('id');

        $('#courseEditId').html(id);
        courseUpdate(id);
        $('#editCourseModal').modal('show');
      })


      $('#corseTableId').DataTable({"order":false});
      $('.dataTables_length').addClass('bs-select');

    }else{
      $('#courseerrDiv').removeClass('d-none');
      $('#courseloadDiv').addClass('d-none');
    }

    }).catch(function (error) {
      $('#courseerrDiv').removeClass('d-none');
      $('#courseloadDiv').addClass('d-none');
    });
    
}

//Add New Btn Clik

$('#adNewCourseId').click(function(){
 
  $('#addCourseModal').modal('show');
});

//Confirm Save
      $('#CourseAddConfirmBtn').click(function(){
       var name =  $('#CourseNameId').val();
       var description = $('#CourseDesId').val();
       var fees = $('#CourseFeeId').val();
       var enroll =$('#CourseEnrollId').val();
       var Courseclass =$('#CourseClassId').val();
       var link =$('#CourseLinkId').val();
       var image =$('#CourseImgId').val();
        courseAddClick(name,description,fees,enroll,Courseclass,link,image);
      })


// Method for Click Add Btn
function courseAddClick(name,description,fees,enroll,Courseclass,link,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else if (fees.length==0){
    toastr.error('fees Required');
  }else if (enroll.length==0){
    toastr.error('enroll Required');
  }else if (Courseclass.length==0){
    toastr.error('class Required');
  }else {
    $('#courseAddBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/courseAdd', {

    course_name:name,
    course_des:description,
    course_fee:fees,
    course_totalenroll:enroll,
    course_totalclass:Courseclass,
    course_link:link,
    course_img:image,

  })
  .then(function(response){
    $('#courseAddBtn').html("Add");
    if (response.data ==1) {
      $('#addCourseModal').modal('hide');
      toastr.success('Save Successfully');
      getCourseData();
      $('#CourseNameId').val('');
      $('#CourseDesId').val('');
      $('#CourseFeeId').val('');
      $('#CourseEnrollId').val('');
      $('#CourseClassId').val('');
      $('#CourseLinkId').val('');
      $('#CourseImgId').val('');
    }else{
      $('#addModal').modal('hide');
      toastr.error('Error in Save');
      getCourseData();
    }
  })
  .catch(function(error){
  });
  }

}


//Confirm Delete
      $('#courseDelConfirmBtn').click(function(){
        var id = $('#courseDeleteId').html();
        courseDelete(id);
      })

// Method for Confirm Delete Data
function courseDelete(delid){
//Animation
  $('#courseDelConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

  axios.post('/coursedelete',{id:delid})
  .then(function(response){
    $('#courseDelConfirmBtn').html("Delete");
    if (response.data ==1) {
      $('#deleteModal').modal('hide');
      toastr.success('Delete Successfully');
      getCourseData();
    }else{
      $('#deleteModal').modal('hide');
      toastr.error('Error in Delete');
      getCourseData();
    }
  })
  .catch(function(error){

  });
}


// Method for Edit Icon Click
function courseUpdate(detailsid){

  axios.post('/courseDetails',{id:detailsid})
  .then(function(response){
    if(response.status == 200){
      $('#courseEditLoader').addClass('d-none');
      $('#courseEditform').removeClass('d-none');

      var jsonData = response.data; 
      $('#CourseNameIdU').val(jsonData[0].course_name);
      $('#CourseDesIdU').val(jsonData[0].course_des);
      $('#CourseFeeIdU').val(jsonData[0].course_fee);
      $('#CourseEnrollIdU').val(jsonData[0].course_totalenroll);
      $('#CourseClassIdU').val(jsonData[0].course_totalclass);
      $('#CourseLinkIdU').val(jsonData[0].course_link);
      $('#CourseImgIdU').val(jsonData[0].course_img);

    }else{
      $('#courseerrDiv').removeClass('d-none');
      $('#courseloadDiv').addClass('d-none');
    }
  })
  .catch(function(error){
    $('#courseerrDiv').removeClass('d-none');
      $('#courseloadDiv').addClass('d-none');
  });
}


//Confirm Edit
      $('#courseUpdateConfirmBtn').click(function(){
        var id = $('#courseEditId').html();
         var name =  $('#CourseNameIdU').val();
       var description = $('#CourseDesIdU').val();
       var fees = $('#CourseFeeIdU').val();
       var enroll =$('#CourseEnrollIdU').val();
       var Courseclass =$('#CourseClassIdU').val();
       var link =$('#CourseLinkIdU').val();
       var image =$('#CourseImgIdU').val();
        courseUpdateClick(id,name,description,fees,enroll,Courseclass,link,image);
      })

// Method for Click Update Btn
function courseUpdateClick(id,name,description,fees,enroll,Courseclass,link,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else if (fees.length==0){
    toastr.error('fees Required');
  }else if (enroll.length==0){
    toastr.error('enroll Required');
  }else if (Courseclass.length==0){
    toastr.error('class Required');
  }else {
    $('#courseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/courseUpdateClick', {
    id:id,
    course_name:name,
    course_des:description,
    course_fee:fees,
    course_totalenroll:enroll,
    course_totalclass:Courseclass,
    course_link:link,
    course_img:image,

  })
  .then(function(response){
    $('#courseUpdateConfirmBtn').html("Update");
    if (response.data ==1) {
      $('#editCourseModal').modal('hide');
      toastr.success('Update Successfully');
      getCourseData();
    }else{
      $('#editCourseModal').modal('hide');
      toastr.error('Error in Update');
      getCourseData();
    }
  })
  .catch(function(error){
  });
  }

}




</script>

@endsection