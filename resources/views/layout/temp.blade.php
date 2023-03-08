<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from wpkixx.com/html/pitnik-dark/newsfeed.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Feb 2023 12:09:59 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Pitnik Social Network Toolkit</title>
    <link rel="icon" href="{{url('images/fav.png" type="image/png" sizes="16x16')}}">

    <link rel="stylesheet" href="{{url('css/main.min.css')}}">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/color.css')}}">
    <link rel="stylesheet" href="{{url('css/responsive.css')}}">
    <link rel="stylesheet" href="{{url('css/dark-theme.css')}}">

    @livewireStyles

</head>
<body>

<div class="se-pre-con"></div>
<div class="theme-layout">

	<div class="postoverlay"></div>

	<div class="responsive-header">
		<div class="mh-head first Sticky">
			<span class="mh-btns-left">
				<a class="" href="#menu"><i class="fa fa-align-justify"></i></a>
			</span>
			<span class="mh-text">
				<a href="newsfeed.html" title=""><img src="images/logo2.png" alt=""></a>
			</span>
			<span class="mh-btns-right">
				<a class="fa fa-sliders" href="#shoppingbag"></a>
			</span>
		</div>
		<div class="mh-head second">
			<form class="mh-form">
				<input placeholder="search" />
				<a href="#/" class="fa fa-search"></a>
			</form>
		</div>

		<nav id="shoppingbag">
			<div>
				<div class="">
					<form method="post">
						<div class="setting-row">
							<span>use night mode</span>
							<input type="checkbox" id="nightmode"/>
							<label for="nightmode" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Notifications</span>
							<input type="checkbox" id="switch2"/>
							<label for="switch2" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Notification sound</span>
							<input type="checkbox" id="switch3"/>
							<label for="switch3" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>My profile</span>
							<input type="checkbox" id="switch4"/>
							<label for="switch4" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Show profile</span>
							<input type="checkbox" id="switch5"/>
							<label for="switch5" data-on-label="ON" data-off-label="OFF"></label>
						</div>
					</form>
					<h4 class="panel-title">Account Setting</h4>
					<form method="post">
						<div class="setting-row">
							<span>Sub users</span>
							<input type="checkbox" id="switch6" />
							<label for="switch6" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>personal account</span>
							<input type="checkbox" id="switch7" />
							<label for="switch7" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Business account</span>
							<input type="checkbox" id="switch8" />
							<label for="switch8" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Show me online</span>
							<input type="checkbox" id="switch9" />
							<label for="switch9" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Delete history</span>
							<input type="checkbox" id="switch10" />
							<label for="switch10" data-on-label="ON" data-off-label="OFF"></label>
						</div>
						<div class="setting-row">
							<span>Expose author name</span>
							<input type="checkbox" id="switch11" />
							<label for="switch11" data-on-label="ON" data-off-label="OFF"></label>
						</div>
					</form>
				</div>
			</div>
		</nav>
	</div><!-- responsive header -->

	<div class="topbar stick">
		<div class="logo">
			<a title="" href="newsfeed.html"><img src="images/logo.png" alt=""></a>
		</div>
		<div class="top-area">
			<div class="main-menu">
				<span>
			    	<i class="fa fa-braille"></i>
			    </span>
			</div>
			<div class="top-search">
				<form method="post" class="">
					<input type="text" placeholder="Search People, Pages, Groups etc">
					<button data-ripple><i class="ti-search"></i></button>
				</form>
			</div>
			<div class="page-name">
			    <span>About</span>
			 </div>
			<ul class="setting-area">
				<li><a href="/homes" title="Home"><i class="fa fa-home"></i></a></li>
				<li>
                            @php
                                $frrequest = auth()->user()->checkfriendrequest();
                            @endphp
					<a href="#" title="Friend Requests" data-ripple="" id="friendrequestcount">
						<i class="fa fa-user"></i>

                            @if($frrequest)
                            <em class="bg-red" id="frrqbt">
                                        {{$frrequest['count']}}
                                </em>
                                @endisset
					</a>
					<div class="dropdowns" id="frienddropdown">
                        @if ($frrequest)
						    @livewire('friend-request',['frrequests'=>$frrequest['requests'],'count'=>$frrequest['count']])
                        @endif
					</div>
				</li>
				<li>
					<a href="#" title="Notification" data-ripple="">
						<i class="fa fa-bell"></i>
                            @php
                                $usar = auth()->user();
                                $check = $usar->checkNotifications();
                            @endphp
                            @if($check)
                                @if($check['count'] != '0')
                                <em class="bg-purple">
                                    @if($check['count'] > 10)10+@else{{$check['count']}}@endif
                                </em>
                                @endif
                            @endif

					</a>
					<div class="dropdowns">
						<span>@if ($check) {{$check['count']}} New Notifications  @endif</span>
						<ul class="drops-menu">
                            @include('other.beybala',['includetopnotifications'=>'a'])

						</ul>
						<a href="/notifications/{{auth()->user()->id}}" title="" class="more-mesg">View All</a>
					</div>
				</li>
				<li>
					<a href="#" title="Messages" data-ripple=""><i class="fa fa-commenting"></i><em class="bg-blue">9</em></a>
					<div class="dropdowns">
						<span>5 New Messages <a href="#" title="">Mark all as read</a></span>
						<ul class="drops-menu">
							<li>
								<a class="show-mesg" href="#" title="">
									<figure>
										<img src="images/resources/thumb-1.jpg" alt="">
										<span class="status f-online"></span>
									</figure>
									<div class="mesg-meta">
										<h6>sarah Loren</h6>
										<span><i class="ti-check"></i> Hi, how r u dear ...?</span>
										<i>2 min ago</i>
									</div>
								</a>
							</li>
							<li>
								<a class="show-mesg" href="#" title="">
									<figure>
										<img src="images/resources/thumb-2.jpg" alt="">
										<span class="status f-offline"></span>
									</figure>
									<div class="mesg-meta">
										<h6>Jhon doe</h6>
										<span><i class="ti-check"></i> We’ll have to check that at the office and see if the client is on board with</span>
										<i>2 min ago</i>
									</div>
								</a>
							</li>
							<li>
								<a class="show-mesg" href="#" title="">
									<figure>
										<img src="images/resources/thumb-3.jpg" alt="">
										<span class="status f-online"></span>
									</figure>
									<div class="mesg-meta">
										<h6>Andrew</h6>
										<span> <i class="fa fa-paperclip"></i>Hi Jack's! It’s Diana, I just wanted to let you know that we have to reschedule..</span>
										<i>2 min ago</i>
									</div>
								</a>
							</li>
							<li>
								<a class="show-mesg" href="#" title="">
									<figure>
										<img src="images/resources/thumb-4.jpg" alt="">
										<span class="status f-offline"></span>
									</figure>
									<div class="mesg-meta">
										<h6>Tom cruse</h6>
										<span><i class="ti-check"></i> Great, I’ll see you tomorrow!.</span>
										<i>2 min ago</i>
									</div>
								</a>
								<span class="tag">New</span>
							</li>
							<li>
								<a class="show-mesg" href="#" title="">
									<figure>
										<img src="images/resources/thumb-5.jpg" alt="">
										<span class="status f-away"></span>
									</figure>
									<div class="mesg-meta">
										<h6>Amy</h6>
										<span><i class="fa fa-paperclip"></i> Sed ut perspiciatis unde omnis iste natus error sit </span>
										<i>2 min ago</i>
									</div>
								</a>
								<span class="tag">New</span>
							</li>
						</ul>
						<a href="chat-messenger.html" title="" class="more-mesg">View All</a>
					</div>
				</li>
			</ul>
			<div class="user-img">
				<h5>{{auth()->user()->name}}</h5>

				<img src="{{asset('storage/'.auth()->user()->image)}}" width="40pc" height="40px" alt="">

				<span class="status f-online"></span>
				<div class="user-setting">
					<span class="seting-title">Chat setting <a href="#" title="">see all</a></span>
					<ul class="chat-setting">
						<li><a href="#" title=""><span class="status f-online"></span>online</a></li>
						<li><a href="#" title=""><span class="status f-away"></span>away</a></li>
						<li><a href="#" title=""><span class="status f-off"></span>offline</a></li>
					</ul>
					<span class="seting-title">User setting <a href="#" title="">see all</a></span>
					<ul class="log-out">
						<li><a href="/homes/{{auth()->user()->id}}" title=""><i class="ti-user"></i> view profile</a></li>
						<li><a href="/settingsedit/{{auth()->user()->id}}" title=""><i class="ti-pencil-alt"></i>edit profile</a></li>
						<li><a href="#" title=""><i class="ti-target"></i>activity log</a></li>
						<li><a href="/settings/{{auth()->user()->id}}" title=""><i class="ti-settings"></i>account setting</a></li>
						<li><a href="/logout" title=""><i class="ti-power-off"></i>log out</a></li>
					</ul>
				</div>
			</div>
			<span class="ti-settings main-menu" data-ripple=""></span>
		</div>
	</div><!-- topbar -->


	<div class="fixed-sidebar left" id="sidebar-left">
		<div class="menu-left">
			<ul class="left-menu">
				<li>
					<a class="menu-small" href="#" title="">
						<i class="ti-menu"></i>
					</a>
				</li>

				<li>
					<a href="/homes" title="Home" data-toggle="tooltip" data-placement="right">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li>
					<a href="/post" title="Add post" data-toggle="tooltip" data-placement="right">
						<i class="fa fa-plus-square-o"></i>
					</a>
				</li>
				<li>
					<a href="/friends/{{auth()->user()->id}}" title="Friends" data-toggle="tooltip" data-placement="right">
						<i class="ti-user"></i>
					</a>
				</li>
				<li>
					<a href="fav-page.html" title="Favourit page" data-toggle="tooltip" data-placement="right">
						<i class="fa fa-star-o"></i>
					</a>
				</li>
				<li>
					<a href="chat-messenger.html" title="Messages" data-toggle="tooltip" data-placement="right">
						<i class="ti-comment-alt"></i>
					</a>
				</li>
				<li>
					<a href="/notifications/{{auth()->user()->id}}" title="Notification" data-toggle="tooltip" data-placement="right">
						<i class="fa fa-bell-o"></i>
					</a>
				</li>

				<li>
					<a href="statistics.html" title="Account Stats" data-toggle="tooltip" data-placement="right">
						<i class="ti-stats-up"></i>
					</a>
				</li>

				<li>
					<a href="support-and-help.html" title="Help" data-toggle="tooltip" data-placement="right">
						<i class="fa fa-question-circle-o">
						</i>
					</a>
				</li>
				<li>
					<a href="faq.html" title="Faq's" data-toggle="tooltip" data-placement="right">
						<i class="ti-light-bulb"></i>
					</a>
				</li>
			</ul>
		</div>
		<div class="left-menu-full">
			<ul class="menu-slide">
				<li><a class="closd-f-menu" href="#" title=""><i class="ti-close"></i> close Menu</a></li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-home"></i> Home Pages</a>
					<ul class="submenu">
						<li><a href="index.html" title="">Pitnik Default</a></li>
						<li><a href="company-landing.html" title="">Company Landing</a></li>
						<li><a href="pitrest.html" title="">Pitrest</a></li>
						<li><a href="redpit.html" title="">Redpit</a></li>
						<li><a href="redpit-category.html" title="">Redpit Category</a></li>
						<li><a href="soundnik.html" title="">Soundnik</a></li>
						<li><a href="soundnik-detail.html" title="">Soundnik Single</a></li>
						<li><a href="career.html" title="">Pitjob</a></li>
						<li><a href="shop.html" title="">Shop</a></li>
						<li><a href="classified.html" title="">Classified</a></li>
						<li><a href="pitpoint.html" title="">PitPoint</a></li>
						<li><a href="pittube.html" title="">Pittube</a></li>
						<li><a href="chat-messenger.html" title="">Messenger</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-film"></i> Pittube</a>
					<ul class="submenu">
						<li><a href="pittube.html" title="">Pittube</a></li>
						<li><a href="pittube-detail.html" title="">Pittube single</a></li>
						<li><a href="pittube-category.html" title="">Pittube Category</a></li>
						<li><a href="pittube-channel.html" title="">Pittube Channel</a></li>
						<li><a href="pittube-search-result.html" title="">Pittube Search Result</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-female"></i>PitPoint</a>
					<ul class="submenu">
						<li><a href="pitpoint.html" title="">PitPoint</a></li>
						<li><a href="pitpoint-detail.html" title="">Pitpoint Detail</a></li>
						<li><a href="pitpoint-list.html" title="">Pitpoint List style</a></li>
						<li><a href="pitpoint-without-baner.html" title="">Pitpoint without Banner</a></li>
						<li><a href="pitpoint-search-result.html" title="">Pitpoint Search</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-graduation-cap"></i>Pitjob</a>
					<ul class="submenu">
						<li><a href="career.html" title="">Pitjob</a></li>
						<li><a href="career-detail.html" title="">Pitjob Detail</a></li>
						<li><a href="career-search-result.html" title="">Job seach page</a></li>
						<li><a href="social-post-detail.html" title="">Social Post Detail</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-repeat"></i>Timeline</a>
					<ul class="submenu">
						<li><a href="timeline.html" title="">Timeline</a></li>
						<li><a href="timeline-photos.html" title="">Timeline Photos</a></li>
						<li><a href="timeline-videos.html" title="">Timeline Videos</a></li>
						<li><a href="timeline-groups.html" title="">Timeline Groups</a></li>
						<li><a href="timeline-friends.html" title="">Timeline Friends</a></li>
						<li><a href="timeline-friends2.html" title="">Timeline Friends-2</a></li>
						<li><a href="about.html" title="">Timeline About</a></li>
						<li><a href="blog-posts.html" title="">Timeline Blog</a></li>
						<li><a href="friends-birthday.html" title="">Friends' Birthday</a></li>
						<li><a href="newsfeed.html" title="">Newsfeed</a></li>
						<li><a href="search-result.html" title="">Search Result</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-heart"></i>Favourit Page</a>
					<ul class="submenu">
						<li><a href="fav-page.html" title="">Favourit Page</a></li>
						<li><a href="fav-favers.html" title="">Fav Page Likers</a></li>
						<li><a href="fav-events.html" title="">Fav Events</a></li>
						<li><a href="fav-event-invitations.html" title="">Fav Event Invitations</a></li>
						<li><a href="event-calendar.html" title="">Event Calendar</a></li>
						<li><a href="fav-page-create.html" title="">Create New Page</a></li>
						<li><a href="price-plans.html" title="">Price Plan</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-forumbee"></i>Forum</a>
					<ul class="submenu">
						<li><a href="forum.html" title="">Forum</a></li>
						<li><a href="forum-create-topic.html" title="">Forum Create Topic</a></li>
						<li><a href="forum-open-topic.html" title="">Forum Open Topic</a></li>
						<li><a href="forums-category.html" title="">Forum Category</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-star-o"></i>Featured</a>
					<ul class="submenu">
						<li><a href="chat-messenger.html" title="">Messenger (Chatting)</a></li>
						<li><a href="notifications.html" title="">Notifications</a></li>
						<li><a href="badges.html" title="">Badges</a></li>
						<li><a href="faq.html" title="">Faq's</a></li>
						<li><a href="contribution.html" title="">Contriburion Page</a></li>
						<li><a href="manage-page.html" title="">Manage Page</a></li>
						<li><a href="weather-forecast.html" title="">weather-forecast</a></li>
						<li><a href="statistics.html" title="">Statics/Analytics</a></li>
						<li><a href="shop-cart.html" title="">Shop Cart</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-gears"></i>Account Setting</a>
					<ul class="submenu">
						<li><a href="setting.html" title="">Setting</a></li>
						<li><a href="privacy.html" title="">Privacy</a></li>
						<li><a href="support-and-help.html" title="">Support & Help</a></li>
						<li><a href="support-and-help-detail.html" title="">Support Detail</a></li>
						<li><a href="support-and-help-search-result.html" title="">Support Search</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-lock"></i>Authentication</a>
					<ul class="submenu">
						<li><a href="login.html" title="">Login Page</a></li>
						<li><a href="register.html" title="">Register Page</a></li>
						<li><a href="logout.html" title="">Logout Page</a></li>
						<li><a href="coming-soon.html" title="">Coming Soon</a></li>
						<li><a href="error-404.html" title="">Error 404</a></li>
						<li><a href="error-404-2.html" title="">Error 404-2</a></li>
						<li><a href="error-500.html" title="">Error 500</a></li>
					</ul>
				</li>
				<li class="menu-item-has-children"><a class="" href="#" title=""><i class="fa fa-wrench"></i>Tools</a>
					<ul class="submenu">
						<li><a href="typography.html" title="">Typography</a></li>
						<li><a href="popup-modals.html" title="">Popups/Modals</a></li>
						<li><a href="post-versions.html" title="">Post Versions</a></li>
						<li><a href="sliders.html" title="">Sliders</a></li>
						<li><a href="google-map.html" title="">Google Maps</a></li>
						<li><a href="widgets.html" title="">Widgets</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div><!-- left sidebar menu -->
    @yield('subreddit')
	<section>
		<div class="gap2 gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="row merged20" id="page-contents">
                                @yield('profile')
                            <div class="col-lg-6">
								<aside class="sidebar static left">
                                    @yield('temp')
                                </aside>
                            </div>
                            <div class="col-lg-6">
								<aside class="sidebar static right">
                                    @yield('righttemp')
                                </aside>
                            </div>
                                    @yield('profileleft')
                                    @yield('profilecenter')
                                    @yield('profileright')
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
    @yield('friends')
    <br><br><br><br><br><br>
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
	<script src="{{url('js/main.min.js')}}"></script>
	<script src="{{url('js/jquery-stories.js')}}"></script>
	<script src="{{url('../../../cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js')}}"></script>
	<script src="{{url('https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI')}}"></script>
	<script src="{{url('js/locationpicker.jquery.js')}}"></script>
	<script src="{{url('js/map-init.js')}}"></script>
	<script src="{{url('js/script.js')}}"></script>

	{{-- <script src="js/main.min.js"></script>


	<script src="js/jquery-stories.js"></script>
	<script src="../../../cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>
	<script src="js/locationpicker.jquery.js"></script>
	<script src="js/map-init.js"></script>
	<script src="js/script.js"></script> --}}



<script>
    $('.goingallup').click(function(){
        const element = document.getElementById('my-element');
    if (element) {
        element.scrollIntoView();
    }
    });
    $('#filter-posts').change(function() {
        var url = $(this).val();
        window.location.href = url;
    });
    function likepost(id){
            $.ajax({
                type: 'POST',
                url: '/like/'+id,
                success: function(data) {
                    if (data.success) {
                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }
        function removeRequest(userid,subid){
            $.ajax({
                type: 'POST',
                url: '/removenotification/'+userid+'/'+subid,
                success: function(data) {
                    if (data.success) {

                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }
        function removenotification(id){
            $.ajax({
                type: 'POST',
                url: '/deletenotification/'+id,
                success: function(data) {
                    if (data.success) {

                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }
        function acceptModRequest(userid,mod,subid){
            $.ajax({
                type: 'POST',
                url: '/acceptmodrequest/'+userid+'/'+mod+'/'+subid,
                success: function(data) {
                    if (data.success) {

                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }
        function acceptFriendRequest(userid){
            $.ajax({
                type: 'POST',
                url: '/unadd/'+userid,
                success: function(data) {
                    if (data.success) {

                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }
        function addTextArea(commentid,subid,postid,event){
            var label = $(event.target);
            label.attr('id','a'+commentid);
            var labelid = label.attr('id');
            label.hide();
            var li = label.closest("li");
            li.attr('id','b'+commentid);
            var liid = li.attr('id');
            var form = '<form action="/commentt/'+commentid+'/'+subid+'/'+postid+'" method="post" style="position:relative;">'+
                '<textarea name="body" placeholder="Post your comment" style="background: rgb(40,46,62) none repeat scroll 0 0;border-color: transparent;border-radius: 5px;color: inherit;font-size: 13px;height: 80px;line-height: 16px;"></textarea>'+
                '<button class="post-btn" type="button" onclick="closeTextArea('+labelid+','+liid+');" data-ripple="" style="bottom: 2px;position: absolute;right: 60px;background: none;">Cancel</button>'+
                '<button class="post-btn" type="submit" data-ripple="" style="bottom: 2px;position: absolute;right: 0;background: none;">Reply</button>'+
                '</form>';
                li.append(form);

        }
        function closeTextArea(labelid,liid){
                    alert(labelid.html());
                }
        function unban(userid,subid){
            $.ajax({
                type: 'POST',
                url: '/unban/'+userid+'/'+subid,
                success: function(data) {
                    if (data.success) {
                        $('#bannedusers-list').empty();
                        data.bannedusers.forEach(function(banneduser) {

                            var li = '<li style="margin-bottom:15px;">' +
                                    '<figure><img src="{{asset('storage')}}' + '/' + banneduser.image + '" width="30px" alt=""></figure>' +
                                    '<div class="friend-meta">' +
                                    '<h4><a href="/homes/'+banneduser.id+'" title="">' + banneduser.name + '</a></h4>' +
                                    '<a href="#" onclick="unban(' + banneduser.id + ','+data.subid+');" title="" class="underline">Unban</a>' +

                                    '</div>' +
                                '</li>';

                        $('#bannedusers-list').append(li);

                        });
                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }
        function takemodrole(id,subid){

            $.ajax({
                type: 'POST',
                url: '/takerole/'+id+'/'+subid,
                success: function(data) {
                    if (data.success) {
                        $('#moderator-list').empty();
                        data.moderators.forEach(function(moderator) {
                            if(moderator.id === data.creator_id){
                                creatorlink = 'Creator of this subreddit';
                                href = '/homes/'+moderator.id;
                                method = '';
                            }else{
                                creatorlink = 'Take mod role';
                                href = '#';
                                method = 'onclick="takemodrole(' + moderator.id + ','+data.subid+');"';
                            }
                            var li = '<li style="margin-bottom:15px;">' +
                                    '<figure><img src="{{asset('storage')}}' + '/' + moderator.image + '" width="30px" alt=""></figure>' +
                                    '<div class="friend-meta">' +
                                    '<h4><a href="/homes/'+moderator.id+'" title="">' + moderator.name + '</a></h4>' +
                                    '<a href="'+href+'" '+method+' title="" class="underline">'+creatorlink+'</a>' +

                                    '</div>' +
                                '</li>';

                        $('#moderator-list').append(li);

                        });
                        data.requestedmods.forEach(function(moderator) {
                            var di = '<li style="margin-bottom:15px;">' +
                                    '<figure><img src="{{asset('storage')}}' + '/' + moderator.image + '" width="30px" alt=""></figure>' +
                                    '<div class="friend-meta">' +
                                    '<h4><a href="/homes/'+moderator.id+'" title="">' + moderator.name + '</a></h4>' +
                                    (moderator.is_creator ? '<a href="#"> Creator of this subreddit</a>' :
                                        '<a href="#" onclick="takemodrequest(' + moderator.id + ','+data.subid+');" title="" class="underline">Take mod Request</a>'
                                    ) +
                                    '</div>' +
                                '</li>';

                        $('#moderator-list').append(di);
                        });
                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }

        function takemodrequest(id,subid){
            // if(confirm('Want to take back mod request')){
            $.ajax({
                type: 'POST',
                url: '/takemodrequest/'+id+'/'+subid,
                success: function(data) {
                    if (data.success) {
                        $('#moderator-list').empty();
                        data.moderators.forEach(function(moderator) {
                            if(moderator.id === data.creator_id){
                                creatorlink = 'Creator of this subreddit';
                                href = '/homes/'+moderator.id;
                                method = '';
                            }else{
                                creatorlink = 'Take mod role';
                                href = '#';
                                method = 'onclick="takemodrole(' + moderator.id + ','+data.subid+');"';
                            }
                            var li = '<li style="margin-bottom:15px;">' +
                                    '<figure><img src="{{asset('storage')}}' + '/' + moderator.image + '" width="30px" alt=""></figure>' +
                                    '<div class="friend-meta">' +
                                    '<h4><a href="/homes/'+moderator.id+'" title="">' + moderator.name + '</a></h4>' +
                                    '<a href="'+href+'" '+method+' title="" class="underline">'+creatorlink+'</a>' +

                                    '</div>' +
                                '</li>';

                        $('#moderator-list').append(li);

                        });
                        data.requestedmods.forEach(function(moderator) {
                            var di = '<li style="margin-bottom:15px;">' +
                                    '<figure><img src="{{asset('storage')}}' + '/' + moderator.image + '" width="30px" alt=""></figure>' +
                                    '<div class="friend-meta">' +
                                    '<h4><a href="/homes/'+moderator.id+'" title="">' + moderator.name + '</a></h4>' +
                                    (moderator.is_creator ? '<a href="#"> Creator of this subreddit</a>' :
                                        '<a href="#" onclick="takemodrequest(' + moderator.id + ','+data.subid+');" title="" class="underline">Take mod Request</a>'
                                        ) +
                                    '</div>' +
                                '</li>';

                        $('#moderator-list').append(di);
                        });
                    }
                    else {

                    }
                },
                error: function() {
                    // Error handling
                }
            });
        }
    // }

       function submitText(id) {
        var text = $('#text-input').val();
        $('#text-input').val('');

        $.ajax({
        type: 'POST',
        url: '/searchmod/'+text+'/'+id,
        success: function(data) {

        if (data.success) {
            // Clear the existing moderator list
            // $('#moderator-list').empty();

            // Add the updated moderators to the list
            if(data.message === '1'){
                alert('this user doesnt exists');
            }else if(data.message === '2'){
                alert('this mf is already a mod');
            }
            else if(data.message === '2.5'){
                alert('This user is banned. If you want to give him a moderator role then open this user s ban');
            }
            else if(data.message === '2.6'){
                alert('You already sent a mod request to this user.');
            }
            else{

            var moderator = data.moderator;
            var li = '<li style="margin-bottom:15px;">' +
                        '<figure><img src="{{asset('storage')}}' + '/' + moderator.image + '" width="30px" alt=""></figure>' +
                        '<div class="friend-meta">' +
                        '<h4><a href="/homes/'+moderator.id+'" title="">' + moderator.name + '</a></h4>' +
                        (moderator.is_creator ? '<a href="#"> Creator of this subreddit</a>' :
                            '<a href="#" onclick="takemodrequest(' + moderator.id + ','+data.subid+');" title="" class="underline">Mod request sended</a>'
                            ) +
                        '</div>' +
                    '</li>';
            $('#moderator-list').append(li);
        }

    }

        else {
            // Handle error
        }
        },
        error: function() {
        // Handle error
        }
    });

  // Close the modal
  $('#myModal').modal('hide');
}
function modban(text,id) {

        $.ajax({
        type: 'POST',
        url: '/banuser/'+text+'/'+id,
        success: function(data) {
        if (data.success) {
            if(data.message === '1'){
                alert('this user doesnt exists');
            }else if(data.message === '2'){
                alert('this mf is already banned');
            }else if(data.message === '2.5'){
                alert('This user is moderator. If you want to ban this user then take this user s role back');
            }else if(data.message === '2.6'){
                alert('First you need to remove the mod request');
            }
        }
    }});
    }
function banUser(id) {
        var text = $('#ban-text-input').val();
        $('#ban-text-input').val('');

        $.ajax({
        type: 'POST',
        url: '/banuser/'+text+'/'+id,
        success: function(data) {
        if (data.success) {
            if(data.message === '1'){
                alert('this user doesnt exists');
            }else if(data.message === '2'){
                alert('this mf is already banned');
            }else if(data.message === '2.5'){
                alert('This user is moderator. If you want to ban this user then take this user s role back');
            }else if(data.message === '2.6'){
                alert('First you need to remove the mod request');
            }
            else{
            var banneduser = data.banneduser;
            var li = '<li style="margin-bottom:15px;">' +
                        '<figure><img src="{{asset('storage')}}' + '/' + banneduser.image + '" width="30px" alt=""></figure>' +
                        '<div class="friend-meta">' +
                        '<h4><a href="/homes/'+banneduser.id+'" title="">' + banneduser.name + '</a></h4>' +
                        (banneduser.is_creator ? '<a href="#"> Creator of this subreddit</a>' :
                            '<a href="#" onclick="unban(' + banneduser.id + ','+data.subid+');" title="" class="underline">Unban</a>'
                            ) +
                        '</div>' +
                    '</li>';
            $('#bannedusers-list').append(li);
        }

    }

        else {
            // Handle error
        }
        },
        error: function() {
        // Handle error
        }
    });

  // Close the modal
  $('#amyModal').modal('hide');
}
   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    $(document).on('click', '#loadmore', function(event) {
    $(this).hide();
    event.preventDefault();
    var nextPageUrl = $(this).attr('href');
    $.get(nextPageUrl, function(data) {
        $('#variable-list').append(data);
        if ($(data).filter(':last').hasClass('load-more-container')) {
            $('#loadmore').attr('href', $(data).filter(':last').find('a').attr('href'));
        } else {
            $('#loadmore').remove();
        }
    });
});
    $('#modrequestlistspan').on('click',function(){
        $('#modrequestlist').css('display','block');
        $('#notificationlist').css('display','none');
        $('#friendrequestlist').css('display','none');
    });
    $('#notificationlistspan').on('click',function(){
        $('#modrequestlist').css('display','none');
        $('#notificationlist').css('display','block');
        $('#friendrequestlist').css('display','none');
    });
    $('#friendrequestlistspan').on('click',function(){
        $('#modrequestlist').css('display','none');
        $('#notificationlist').css('display','none');
        $('#friendrequestlist').css('display','block');
    });
    $('#trigger').click(function(){
        $('#yourmother').click();
    });
    $('#friendrequestcount').click(function(){
        $('#frrqbt').css('display','none');
    });
    $('#avatar-preview').click(function(){
        $('#avatar').click();
    });
    $('#change').click(function(){
        $('#edita').click();
    });
    $('#edited-post-preview').click(function(){
        $('#edita').click();
    });
    $('#came-post-preview').click(function(){
        $('#edita').click();
    })
    $('#joinbuttontrigger').on('click',function(event){
        event.preventDefault();
        $('#joinsubmit').click();
    });
    $('#blahh').hide();
    $('#customFile1').on('change', function() {
    // Get the file input element
    var input = $(this)[0];
    // Check if any files are selected
    if (input.files && input.files[0]) {
      // Create a FileReader object
      var reader = new FileReader();
      // Set the image source when it's loaded
      reader.onload = function(e) {
        $('#blahh').attr('src', e.target.result);
      };
      // Load the selected file
      reader.readAsDataURL(input.files[0]);
      $("#blahh").show();
    }
  });
  // Hide the blurry overlay by default
  $('.blurry-overlay').hide();

  // Show the blurry overlay and the select element when clicked
  $('.blurry-select').on('click', function() {
    $('.blurry-overlay').show();
    $(this).addClass('active');
  });

  // Hide the blurry overlay and the select element when an option is selected
  $('.blurry-select option').on('click', function() {
    $('.blurry-overlay').hide();
    $('.blurry-select').removeClass('active');
  });

</script>
@livewireScripts
</body>

<!-- Mirrored from wpkixx.com/html/pitnik-dark/newsfeed.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Feb 2023 12:09:59 GMT -->
</html>
