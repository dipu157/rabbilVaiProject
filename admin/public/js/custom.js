
//Get Visitor Data
$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


//Get Service Data
function getServiceData(){

    axios.get('/serviceget')
  .then(function (response) {

    if(response.status == 200){

      $('#mainDiv').removeClass('d-none');
      $('#loadDiv').addClass('d-none');

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

      //Confirm Delete
      $('#serviceDelConfirmBtn').click(function(){
        var id = $('#serviceDeleteId').html();
        serviceDelete(id);
      })

      //Edit Icon
      $('.serviceEditBtn').click(function(){
        var id = $(this).data('id');

        $('#serviceEditId').html(id);
        serviceUpdate(id);
        $('#editModal').modal('show');
      })

      //Confirm Edit
      $('#serviceUpdateBtn').click(function(){
        var id = $('#serviceEditId').html();
        var name = $('#service_nameId').val();
        var description = $('#service_desId').val();
        var image = $('#service_imgId').val();
        serviceUpdateClick(id,name,description,image);
      })



    }else{
      $('#errDiv').removeClass('d-none');
      $('#loaderDiv').addClass('d-none');
    }

    }).catch(function (error) {
      $('#errDiv').removeClass('d-none');
      $('#loaderDiv').addClass('d-none');
    });
    
}


// Method for Confirm Delete Data
function serviceDelete(delid){

  axios.post('/servicedelete',{id:delid})
  .then(function(response){
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


// Method for Click Update Btn
function serviceUpdateClick(id,name,description,image){

  if(name.length==0){
    toastr.error('Name Required');
  }else if (description.length==0){
    toastr.error('Description Required');
  }else {
    axios.post('/serviceUpdateClick', {
    id:id,
    service_name:name,
    service_des:description,
    service_img:image,

  })
  .then(function(response){
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