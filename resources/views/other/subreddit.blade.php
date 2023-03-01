@extends('layout.temp')
@section('subreddit')
    {{-- <h1>{{$subreddit->name}} @can('subredditdelete',$subreddit)
        - Created by you <a href="/bannedusers/{{$subreddit->id}}">Banned users</a>
        @elsecan('moddelete',$subreddit)
        -Moderator of that subreddit <a href="/bannedusers/{{$subreddit->id}}">Banned users</a>
    @endcan</h1>
    <img src="{{asset('storage/'.$subreddit->image)}}" width="80px" height="45">
    @can('subredditdelete',$subreddit)
        <form action="/subreddit/{{$subreddit->id}}" method="post">
            @csrf
            @method('delete')
            <button type="submit">Delete</button>
        </form>
    @endcan
    @if (auth()->user()->isBanned($subreddit))
        You ARE BANNED FROM THIS SUBREDDIT BUT YOU CAN STILL LOOK POSTS
        @else
        <form action="/join/{{$subreddit->id}}" method="post">
            @csrf
            @if ($aton === 1)
                <button type="submit">Leave</button>
            @elseif($aton === 0)
                <button type="submit">Join</button>
            @endif
        </form>
    @endif
    <h3>Joins:{{$subreddit->users->count()}}</h3>
    <br> <br>
    <h1>POSTS</h1> <br>
    @foreach ($subreddit->posts as $post)
    @include('other.post')
    @endforeach --}}
    <section>
		<div class="gap2 gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="featured-baner mate-black low-opacity">
                            @php
                                $baner = explode('/',$subreddit->image);
                            @endphp
							<img src="{{asset('storage/'.$baner[1])}}" alt="">
							<h3>{{$subreddit->name}}</h3>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="pitred-links central-meta">
							<a href="#" title="" class="main-btn">Create Post+</a>
							<ul>
								<li><a href="#" title="">All</a></li>
								<li><a href="#" title="">Home</a></li>
								<li><a href="#" title="">Trending</a></li>
								<li><a href="#" title="">Top Communities</a></li>
								<li><a href="#" title="">Friends</a></li>
								<li><a href="#" title="">Videos</a></li>
								<li>
									<div class="more">
										<i class="fa fa-ellipsis-h"></i>
										<ul class="more-dropdown">
											<li>
												<a href="#">Report Profile</a>
											</li>
											<li>
												<a href="#">Block Profile</a>
											</li>
										</ul>
									</div>
								</li>
							</ul>
							<div class="con-pts">
								<a class="coin-btn" href="#" title="">Get Coins</a>
								<div class="pit-points">
									<span>Your's Total Points</span>
									<i>2.6k</i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- top banner -->

	<section>
		<div class="gap no-top gray-bg">
			<div class="container">
				<div class="row" id="page-contents">
					<div class="col-lg-3">
						<aside class="sidebar static left">
							<div class="friend-box">
								<figure>
									<img alt="" src="{{asset('storage/'.$baner[0])}}">
									<span>{{$subreddit->users->count()}}</span>
								</figure>
								<div class="frnd-meta">
									<img alt="" src="images/resources/frnd-figure3.jpg">
									<div class="frnd-name">
										<a title="" href="#">{{$subreddit->name}}</a>
									</div>
                                    @if($subreddit->creator_id != auth()->user()->id)
                                        @if (auth()->user()->isBanned($subreddit))
                                        <a class="main-btn2" href="#" title="">Already Banned</a>
                                        @else
                                        <form action="/join/{{$subreddit->id}}" method="post" style="display:none;">
                                            @csrf
                                            <button type="submit" id="joinsubmit"></button>
                                        </form>
                                        <a class="main-btn2" href="#" id="joinbuttontrigger" title="">@if($user->isJoined($subreddit)) Leave @else Join @endif</a>
                                        @endif
                                @else
                                <a class="main-btn2" href="#" title="">Delete</a>
                                @endif
								</div>
								<ul class="menu-list">
									<li><a href="#" title="" data-ripple=""><i class="fa fa-home"></i>Home</a></li>
									<li><a href="#" title="" data-ripple=""><i class="fa fa fa-superpowers"></i>Top</a></li>
									<li><a href="#" title="" data-ripple=""><i class="fa fa-smile-o"></i>Best</a></li>
									<li><a href="#" id="newcategory" title="" data-ripple=""><i class="fa fa-certificate"></i>New</a></li>
									<li><a href="#" title="" data-ripple=""><i class="fa fa-fire"></i>Hot</a></li>
									<li><a href="#" title="" data-ripple=""><i class="fa fa-sun-o"></i>Rising</a></li>
									<li><a href="#" title="" data-ripple=""><i class="fa fa-eercast"></i>Controversial</a></li>
									<li><a href="#" title="" data-ripple=""><i class="fa fa-question-circle"></i>Help</a></li>
									<li><a href="#" title="" data-ripple=""><i class="fa fa-medkit"></i>Send Feedback</a></li>
								</ul>
							</div>
							<div class="widget">
								<div class="top-comunitez">
									<figure>
										<img src="images/resources/widget-baner.jpeg" alt="">
										<span>Top communities</span>
									</figure>
									<ol class="top-comuty">
                                        @foreach ($subreddits as $subreddit)
                                        @if($loop->iteration >=10)
                                        @break
                                            @endif
                                            @php
                                                $pp = explode('/',$subreddit->image);
                                            @endphp
                                            <li>
                                                <img src="{{asset('storage/'.$pp[0])}}" width="40px" height="40px" alt="">
                                                <a href="#" title="">{{$subreddit->name}}</a>
                                            </li>

                                        @endforeach

									</ol>
									<div class="tags_">
										<a href="#" title="">News</a>
										<a href="#" title="">Gaming</a>
										<a href="#" title="">Sports</a>
										<a href="#" title="">Health</a>
										<a href="#" title="">Website</a>
									</div>
									<a class="main-btn" href="#" title="">View All</a>
								</div>
							</div>
						</aside>
					</div>
                    <div class="col-lg-6">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="pst-change-style">
									<select id="filter-posts">
                                        <option value="">New</option>
                                        <option value="/subreddit/{{$subreddit->id}}/today" @isset($tudik) selected @endisset>Top of today</option>
                                        <option value="/subreddit/{{$subreddit->id}}/week" @isset($wedik) selected @endisset>Top of this week</option>
                                        <option value="/subreddit/{{$subreddit->id}}/month" @isset($modik) selected @endisset>Top of this month</option>
                                        <option value="/subreddit/{{$subreddit->id}}/all" @isset($adik) selected @endisset>Top of all time</option>
                                      </select>
								</div>
							</div>
						</div>
						<div class="load-more" id="resetloop">
                            @isset($posts)
                                @foreach($posts as $post)
                                    @include('other.post')
                                @endforeach
                            @else
                                @foreach($newposts as $post)
                                    @include('other.post')
                                @endforeach
                            @endisset
						</div>
					</div>
                    <div class="col-lg-3">
                        <aside class="sidebar static right">
                            <div class="widget">
                                <h4 class="widget-title">Moderators</h4>
                                <ul class="followers">
                                    @foreach ($subreddit->moderators as $subs)
                                        <li>
                                            <figure><img src="{{asset('storage/'.$subs->image)}}" width="30px" alt=""></figure>
                                            <div class="friend-meta">
                                                <h4><a href="time-line.html" title="">{{$subs->name}}</a></h4>
                                                <a href="/subreddit/{{$subs->id}}" title="" class="underline">Go</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </div>
				</div>
			</div>
		</div>
	</section><!-- content -->
    {{-- <script>
        document.getElementById('sidebar-left').style.display = "none";

    </script> --}}
@endsection
