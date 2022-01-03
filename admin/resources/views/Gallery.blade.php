@extends('layout.app')
@section('title','Gallery')

@section('content')
	
	<div id="mainDiv" class="container">
  <div class="row">
    <div class="col-md-12 p-5">

      <button id="adNewPhotoBtn" class="btn btn-primary my-3">Add New</button>

    </div>
  </div>
</div>

<div class="container">
  <div id="photorow" class="row photoRow">

  </div>
</div>

<button class="btn btn-primary" id="LoadMoreBtn">Load More</button>


<!-- Modal For Add Service -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header p-3 text-center">
        <h5 class="modal-title">Add New Photo</h5>          
      </div>

      <div class="modal-body">
        <input id="imgInput" type="file">
        <img style="width: 100px; height: 400px;" class="w-100" src="" id="imgPreview">
      </div>
          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="photoAddBtn" type="button" class="btn btn-success">Add</button>
      </div>
    </div>
  </div>
</div>


@endsection


@section('script')
<script type="text/javascript">
	$('#adNewPhotoBtn').click(function(){
 
  $('#addModal').modal('show');
});

$('#imgInput').change(function(){
  var reader = new FileReader();
  reader.readAsDataURL(this.files[0]);
  reader.onload=function(e){
    var imageSource = e.target.result;
    $('#imgPreview').attr('src',imageSource);
  }
});

$('#photoAddBtn').on('click',function(){

  $('#photoAddBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")

  var photoFile = $('#imgInput').prop('files')[0];
  var formData = new FormData();
  formData.append('photo',photoFile);

  axios.post("/photoUp",formData)
  .then(function (response){
    
    if(response.status == 200 && response.data==1){
      $('#addModal').modal('hide');
      $('#addModal').html('Save');
      toastr.success("Photo Upload Successfully");
    }else{
      $('#addModal').modal('hide');
      $('#addModal').html('Save');
      toastr.error("Photo Upload Failed");
    }

  }).catch(function (error){
    alert(error);
  })
});

photoLoad();

function photoLoad(){

  axios.get("/photoLoad")
  .then(function (response){

    var dataJSON=response.data;
    $.each(dataJSON, function(i, item) {
      $("<div class='col-md-3 p-1'>").html(
        "<img data-id="+ item['id']+" class='imageOnRow' src="+item['location']+">"+
        "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn btn-sm deletePhoto btn-danger'> Delete </button>"
        ).appendTo('.photoRow');
    })

    $('.deletePhoto').on('click',function (e){

      let id = $(this).data('id');
      let photo = $(this).data('photo');
      PhotoDelete(photo,id);
      e.preventDefault();
      })

  })
  .catch(function (error){

  })
}

$('#LoadMoreBtn').on('click',function(){

  var firstImgId = $(this).closest('div').find('img').data('id'); 
  
  loadById(firstImgId);
});


var imgId = 0; 
function loadById(firstImgId){

  imgId = imgId+3;
  let photoId = imgId + firstImgId;
  let url = "/photoLoadByid/"+photoId;
  axios.get(url)
  .then(function (response){
    var dataJSON=response.data;
    $.each(dataJSON, function(i, item) {
      $("<div class='col-md-3 p-1'>").html(
        "<img data-id="+ item['id']+" class='imageOnRow' src="+item['location']+">"+
        "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn btn-sm deletePhoto btn-danger'> Delete </button>"
        ).appendTo('.photoRow');
    })

  })
  .catch(function (error){

  })
}

function PhotoDelete(oldPhotoUrl,id){
    let url = "/photoDelete";
    let myformData = new FormData();
    myformData.append('oldPhotoUrl',oldPhotoUrl);
    myformData.append('id',id);
    axios.post(url,myformData)  
    .then(function (response){
      if(response.status == 200 && response.data == 1){
        toastr.success("Photo Delete Success");
        $(".photoRow").empty();
        photoLoad();

      }else{
        toastr.error("Photo Delete Failed");
      }
    }).catch(function (error){
      toastr.error("Photo Delete Failed");
    })
  }

</script>

@endsection