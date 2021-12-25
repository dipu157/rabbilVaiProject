$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});

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
          "<td><a href=''><i class='fas fa-edit'></i></a></td>" +
          "<td><a class='serviceDeleteBtn' data-id="+dataJSON[i].id+" ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#service_table');
    });

      $('.serviceDeleteBtn').click(function(){
        var id = $(this).data('id');
        $('#serviceDeleteId').html(id);
        $('#deleteModal').modal('show');
      })

      $('#serviceDelConfirmBtn').click(function(){
        var id = $('#serviceDeleteId').html();
        serviceDelete(id);
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
