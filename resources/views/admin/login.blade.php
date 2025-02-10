<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>TDNC</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="{{url("frontend/plugins/fontawesome/js/all.min.js")}}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{url("frontend/css/portal.css")}}">

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="{{url("frontend/images/app-logo.svg")}}" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Login </h2>
			        <div class="auth-form-container text-start">
						<div>
							@if(session()->has('message'))
							
							<div class="alert alert-danger">
							
								{{-- <div class="alert alert-danger" role="alert">
  This is a danger alert—check it out!
</div> --}}
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								{{session()->get('message')}}
							
							
							</div>
							
							@endif
						</div>
						<form class="auth-form login-form" action="{{url('/')}}/login" method="POST">
							@csrf         
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Email</label>
								<input id="signin-email" name="signin-email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
							</div><!--//form-group-->
							
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<input id="signin-password" name="signin-password" type="password" class="form-control signin-password" placeholder="Password" required="required">
								
								<div class="extra mt-3 row justify-content-between">

									
									{{-- <div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Remember me
											</label>
										</div>
									</div><!--//col-6--> --}}
									{{-- <div class="col-6">
										<div class="forgot-password text-end">
											<a href="reset-password.html">Forgot password?</a>
										</div>
									</div><!--//col-6--> --}}
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto" name="submit">Log In</button>
							</div>
						</form>
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
				<footer class="app-footer">
					<div class="container text-center py-3">
						<small>&#174; 2070 Tucha Dhuku Newa Chatamari</small>
				
					</div>
				</footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

