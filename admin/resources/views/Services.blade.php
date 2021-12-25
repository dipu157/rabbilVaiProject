@extends('layout.app')

@section('content')


<div id="mainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">
      <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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


<!-- Modal -->
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
</script>
@endsection