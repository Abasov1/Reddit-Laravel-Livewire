<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wpkixx.com/html/pitnik-dark/logout.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Feb 2023 12:15:56 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
	<title>Pitnik Social Network Toolkit</title>
    <link rel="icon" href="images/fav.png" type="image/png" sizes="16x16">

    <link rel="stylesheet" href="css/main.min.css">
	<link rel="stylesheet" href="css/weather-icon.css">
	<link rel="stylesheet" href="css/weather-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/dark-theme.css">

</head>
<body>
<!--<div class="se-pre-con"></div>-->
<div class="theme-layout">


	<div class="topbar stick">
		<div class="logo">
			<a title="" href="newsfeed.html"><img src="images/logo.png" alt=""></a>
		</div>
	</div><!-- topbar -->

	<section>
		<div class="page-header">
			<div class="header-inner">
				<h2>Now You are out of Pitnik</h2>
				<p>
					Discover what's happining right now in the world.
				</p>
			</div>
			<figure><img src="images/resources/baner-forum.png" alt=""></figure>
		</div>
	</section><!-- sub header -->

	<section>
		<div class="gap gray-bg">
			<div class="container-fluid">
				<div class="row">
					<div class="offset-lg-1 col-lg-10">
						<div class="row border-center">
							<div class="col-lg-7 col-md-6 ">
								<div class="logout-f">
									<h4><i class="fa fa-key"></i> Login</h4>
									<p>Wanna try something different from observing then login </p>
									<div class="logout-form">
										<form  action="/login" method="post" class="again-login">
                                            @csrf
											<input name="email" type="email" @error('email') style="border-style:solid;border-color: red;" @enderror placeholder="Email" value="{{old('email')}}">
                                            @error('email')
                                                <p style="text-color:red;color:red;margin-left:10px">{{$message}}</p>
                                            @enderror
											<input name="password" type="password" @error('password') style="border-style:solid;border-color: red;" @enderror placeholder="Password" value="{{old('password')}}">
                                            @error('password')
                                                <p style="text-color:red;color:red;margin-left:10px">{{$message}}</p>
                                            @enderror
                                            <label for="remember" id="remember-label">Remember me</label>
                                            <input type="checkbox" name="remember" style="display:inline-block" id="remember" {{ old('remember') ? 'checked' : '' }}><br>
											<button type="submit">Login</button>
										</form>
										<p>Don t have account? <a href="/register" title="">Register</a></p>
									</div>
								</div>
							</div>
						</div>
						<div class="sub-total" style="margin-left: 30px;">
							<div class="row">
								<div class="col-lg-0.1 col-md-0.1 col-sm-0.1">
									<div class="total">
										<i class="ti-check"></i>
										<span>Registerd Users</span>
										<em>{{$users->count()}}</em>
									</div>
								</div>
								<div class="col-lg-0.1 col-md-0.1 col-sm-0.1">
									<div class="total">
										<i class="ti-image"></i>
										<span>Subreddits created</span>
										<em>{{$subreddits->count()}}</em>
									</div>
								</div>
								<div class="col-lg-0.1 col-md-0.1 col-sm-0.1">
									<div class="total">
										<i class="fa fa-users"></i>
										<span>Posts published</span>
										<em>{{$posts->count()}}</em>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="bottombar">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<span class="copyright">© Pitnik 2020. All rights reserved.</span>
					<i><img src="images/credit-cards.png" alt=""></i>
				</div>
			</div>
		</div>
	</div>
</div>


	<div class="popup-wraper6">
		<div class="popup login">
			<span class="popup-closed"><i class="ti-close"></i></span>
			<div class="popup-meta">
				<div class="popup-head">
					<h5><i class="ti-key"></i> Login to Pitnik</h5>
				</div>
				<div class="login-frm">
					<input type="text" placeholder="User Name">
					<input type="password" placeholder="Password">
					<div class="checkbox">
					  <label>
						<input type="checkbox" checked="checked"><i class="check-box"></i>Remember Password
					  </label>
					</div>
					<button data-ripple="" type="submit" class="main-btn">Login</button>
					<a href="#" title="">Forgotten password?</a>
				</div>
			</div>
		</div>
	</div><!-- upload popup -->

	<script src="js/main.min.js"></script>
	<script src="js/script.js"></script>

</body>

<!-- Mirrored from wpkixx.com/html/pitnik-dark/logout.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Feb 2023 12:15:57 GMT -->
</html>
