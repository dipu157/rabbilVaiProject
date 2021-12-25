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

      var dataJSON=response.data;
      $.each(dataJSON, function(i, item) {
      $('<tr>').html(
          "<td><img class='table-img' src="+dataJSON[i].service_img +"></td>"+
          "<td>" + dataJSON[i].service_name + "</td>" +
          "<td>" + dataJSON[i].service_des + "</td>" +
          "<td><a href=''><i class='fas fa-edit'></i></a></td>" +
          "<td><a href='' ><i class='fas fa-trash-alt'></i></a></td>"
          ).appendTo('#service_table');
    });
    }else{
      $('#errDiv').removeClass('d-none');
      $('#mainDiv').addClass('d-none');
      $('#loaderDiv').addClass('d-none');
    }

    }).catch(function (error) {
      $('#errDiv').removeClass('d-none');
      $('#mainDiv').addClass('d-none');
      $('#loaderDiv').addClass('d-none');
    });
    
}
