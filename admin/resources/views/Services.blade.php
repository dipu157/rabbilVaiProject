@extends('layout.app')

@section('content')


<div class="container">
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
  <tbody>
  
  @foreach($serviceData as $item)
	<tr>
      <th class="th-sm"><img class="table-img" src="{{$item->service_img}}"></th>
	  <th class="th-sm">{{$item->service_name}}</th>
	  <th class="th-sm">{{$item->service_des}}</th>
	  <th class="th-sm"><a href="" ><i class="fas fa-edit"></i></a></th>
	  <th class="th-sm"><a href="" ><i class="fas fa-trash-alt"></i></a></th>
    </tr>	
	@endforeach
	
  </tbody>
</table>

</div>
</div>
</div>


@endsection