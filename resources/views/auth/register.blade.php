{{-- @extends('layout.app')
@section('app')

    <form action="/register" enctype="multipart/form-data" method="post">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}"><br>
        @error('name')
            {{$message}}
        @enderror <br>
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email')
            {{$message}}
        @enderror <br>
        <input type="password" name="password" value="{{ old('password') }}"> <br>
        @error('password')
            {{$message}}
        @enderror <br>
        <input type="password" name="password_confirmation"><br><br>
        profil:
        <input type="file" name="image" id="image" onchange="readURL(this);"><br>
        @error('image')
            {{$message}}
        @enderror <br>
        <input type="submit" value="qeydiyyatdan kec"><br>
    </form>
    <img id="blah" src="http://placehold.it/180"  width="100px" height="auto"/> <br>
    <script>
        $('#blah').hide();
            $('#negar').show();
            $('#yourmom').hide();
             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $('#blah').show();
                $('#negar').hide();
                $('#yourmom').show();
            }
        }
    </script>
@endsection --}}
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

		<div class="top-area">
			<div class="top-search">
				<form method="post" class="">
					<input type="text" placeholder="Search People, Pages, Groups etc">
					<button data-ripple><i class="ti-search"></i></button>
				</form>
			</div>
			<div class="page-name">
			    <span>Logout</span>
			</div>
			<ul class="setting-area">
				<li><a data-ripple="" title="Home" href="newsfeed.html"><i class="fa fa-home"></i></a></li>
				<li><a href="#" title="Help" data-ripple=""><i class="fa fa-question-circle"></i></a>
					<div class="dropdowns helps">
						<span>Quick Help</span>
						<form method="post">
							<input type="text" placeholder="How can we help you?">
						</form>
						<span>Help with this page</span>
						<ul class="help-drop">
							<li><a href="#" title=""><i class="fa fa-book"></i>Terms and Conditions</a></li>
							<li><a href="#" title=""><i class="fa fa-question-circle-o"></i>FAQs</a></li>
							<li><a href="#" title=""><i class="fa fa-building-o"></i>Carrers</a></li>
							<li><a href="#" title=""><i class="fa fa-map-marker"></i>Contact</a></li>
							<li><a href="#" title=""><i class="fa fa-pencil-square-o"></i>Privacy Policy</a></li>
							<li><a href="#" title=""><i class="fa fa-exclamation-triangle"></i>Report a Problem</a></li>
						</ul>
					</div>
				</li>
				<li><a class="text" data-ripple="" title="Privacy" href="policies.html">Privacy & Policy</a></li>
				<li><a class="text" data-ripple="" title="Privacy" href="about.html">Contact</a></li>
				<li><a class="text" data-ripple="" title="Privacy" href="faq.html">Faq's</a></li>
				<li><a class="text" data-ripple="" title="Privacy" href="forum.html">Forum</a></li>
			</ul>
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
							{{-- <div class="col-lg-6 col-md-6">
								<div class="already-log">
									<h4>Recent Login</h4>
									<p>Next Time you login click your picture. To remove an account from this page click cross.</p>
									<div class="log-user">
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-4">
												<div class="user-log">
													<i class="ti-close" title="Remove Account"></i>
													<a href="#" title=""><img src="images/resources/author.jpg" alt="">
													<span>Adam James</span>
													</a>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4">
												<div class="user-log">
													<i class="ti-close" title="Remove Account"></i>
													<a href="#" title=""><img src="images/resources/author2.jpg" alt="">
													<span>Emma Watson</span>
													</a>
												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4">
												<div class="user-add">
													<div><i class="ti-plus"></i><span>Add Account</span></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> --}}
							<div class="col-lg-7 col-md-6 ">
								<div class="logout-f">
									<h4><i class="fa fa-key"></i> Register</h4>
									<p>Create new inspiring profile</p>
                                                                        {{-- @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif --}}
									<div class="logout-form">
										<form  action="/register" method="post" class="again-login"  enctype="multipart/form-data">
                                            @csrf
											<input name="name" type="text" @error('name') style="border-style:solid;border-color: red;" @enderror placeholder="Name" value="{{old('name')}}">
                                            @error('name')
                                                <p style="text-color:red;color:red;margin-left:10px">{{$message}}</p>
                                            @enderror
                                            <input name="email" type="email" @error('email') style="border-style:solid;border-color: red;" @enderror placeholder="Email" value="{{old('email')}}">
                                            @error('email')
                                                <p style="text-color:red;color:red;margin-left:10px">{{$message}}</p>
                                            @enderror
											<input name="password" type="password" @error('password') style="border-style:solid;border-color: red;" @enderror placeholder="Password" value="{{old('password')}}">
                                            @error('password')
                                                <p style="text-color:red;color:red;margin-left:10px">{{$message}}</p>
                                            @enderror

											<input name="password_confirmation" type="password" placeholder="Password Confirmation">
                                            {{-- <label for="avatar">Avatar</label>
                                            <div class="avatar-upload" >
                                                <div class="avatar-preview">
                                                    <img id="avatar-preview" src="https://cdn.oneesports.gg/cdn-data/2022/11/MW2_Ghost_Mask.jpg" alt="Preview">
                                                </div>
                                                <div class="avatar-edit">
                                                    <input type='file' id="avatar" name="avatar" accept=".png, .jpg, .jpeg" />
                                                    <label for="avatar">Choose Avatar</label>
                                                </div>
                                            </div>
                                            @error('avatar')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror --}}

                                            <div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="avatarModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                  <div class="modal-content" style="background-color:rgb(6,8,24);">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="avatarModalLabel">Choose Avatar</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                                        <span aria-hidden="true" style="color:rgb(149,154,181);">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="avatar-upload">
                                                        <div class="avatar-preview">
                                                          <img id="avatar-preview" src="https://cdn.oneesports.gg/cdn-data/2022/11/MW2_Ghost_Mask.jpg" alt="Preview">
                                                        </div>
                                                        <div class="avatar-edit">
                                                          <input type='file' id="avatar" name="image" accept=".png, .jpg, .jpeg" />
                                                          <label for="avatar" >Choose Avatar</label>
                                                        </div>
                                                      </div>
                                                      @error('image')
                                                      <div class="alert alert-danger">{{ $message }}</div>
                                                      @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" data-dismiss="modal">Close</button>
                                                      <button type="button" data-dismiss="modal">Save changes</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>

											<button type="submit" style="margin-left:10 px">Register</button>
                                            <button type="button" style="background-color:rgb(250,99,66);margin-right:10px;@error('image') border-style:solid;border-color:red; @enderror" data-toggle="modal" data-target="#avatarModal">
                                                Choose Avatar
                                              </button>
										</form>
										<p>Already have a account? <a href="/login" title="">Login</a></p>
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#avatar").change(function(){
            readURL(this);
        });
    </script>

</body>

<!-- Mirrored from wpkixx.com/html/pitnik-dark/logout.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Feb 2023 12:15:57 GMT -->
</html>
