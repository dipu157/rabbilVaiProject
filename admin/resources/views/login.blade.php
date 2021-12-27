<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidenav.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables-select.min.css')}}">
</head>
<body class="fix-header fix-sidebar">

<div class="container">
	<div class="row justify-content-center d-flex mt-5 mb-5">
		<div class="card">

  <h5 class="card-header info-color white-text text-center py-4">
    <strong>Sign in</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">

    <!-- Form -->
    <form action=" " class="text-center loginForm" style="color: #757575;" >

      <!-- Email -->
      <div class="md-form">
        <input name="userName" value="" type="email" class="form-control">
        <label for="">E-mail</label>
      </div>

      <!-- Password -->
      <div class="md-form">
        <input name="password" value="" type="password" class="form-control">
        <label for="">Password</label>
      </div>

      <div class="d-flex justify-content-around">
        <div>
          <!-- Remember me -->
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
            <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
          </div>
        </div>
        <div>
          <!-- Forgot password -->
          <a href="">Forgot password?</a>
        </div>
      </div>

      <!-- Sign in button -->
      <button name="submit" type="submit" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" >Sign in</button>

      <!-- Register -->
      <p>Not a member?
        <a href="">Register</a>
      </p>

    </form>
    <!-- Form -->

  </div>

</div>
	</div>
</div>

</div>
</div>

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/sidebarmenu.js')}}"></script>
<script src="{{asset('js/sticky-kit.min.js')}}"></script>
<script src="{{asset('js/custom.min-2.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="{{asset('js/datatables-select.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>


<script type="text/javascript">
	
	$('.loginForm').on('submit',function(e){
		e.preventDefault();

		var formData=$(this).serializeArray();
		var username = formData[0]['value'];
		var password = formData[1]['value'];

		axios.post('/login',{
			user:username,
			pass:password
		})
		.then(function(response){

			if(response.status == 200 && response.data == 1){
				window.location.href="/dashboard";
			}else{
				toastr.error('Login Filed! Try Again');
			}

		}).catch(function(error){
			toastr.error('Login Filed! Try Again');
		})
	})


</script>
</body>
</html>