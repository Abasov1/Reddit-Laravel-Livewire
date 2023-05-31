@if($sectionoff)
@extends('layout.temp')
@section('subreddit')
<section>
@endif
	<section id="content">
		<div class="gap gray-bg">
			<div class="container">
				<div class="row" id="page-contents">
                    @php
                        $baner = explode('/',$subreddit->image);
                    @endphp
                    <div class="col-lg-8">
                        <div class="featured-baner mate-black low-opacity">
                            @php
                                $baner = explode('/',$subreddit->image);
                            @endphp
                            <img src="{{asset('storage/'.$baner[1])}}" alt="">
                            <h3>{{$subreddit->name}}</h3>
                        </div>
                        <div class="row" style="margin-left:77%;margin-top:20px;">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="pst-change-style" >
                                    <select id="filter-posts">
                                        <option value="1">New</option>
                                        <option value="2">Top of today</option>
                                        <option value="3">Top of this week</option>
                                        <option value="4">Top of this month</option>
                                        <option value="5">Top of all time</option>
                                      </select>
                                </div>
                            </div>
                        </div>
                    @livewire('filter-subreddit',['subreddit'=>$subreddit])
                    </div>
                    <div class="col-lg-4">
                        <aside class="sidebar static right">
							<div class="friend-box" >
								<figure>
									<img alt="" src="{{asset('storage/'.$baner[0])}}">
									<span>{{$subreddit->users->count()}}</span>
								</figure>
								<div class="frnd-meta" >
									<div style="display:flex;justify-content:center;">
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
                                        @if(auth()->user()->isJoined($subreddit))<a class="main-btn2" href="/createpost/{{$subreddit->id}}" title="">Create post</a>@endif
                                        <a class="main-btn2" href="#" id="joinbuttontrigger" title="">@if(auth()->user()->isJoined($subreddit)) Leave @else Join @endif</a>
                                        @endif
                                    @else
                                    <a class="main-btn2" href="/subsettings/{{$subreddit->id}}">Modify</a>
                                @endif
								</div>
								<div style="display:flex;justify-content:center;">
								<b>About this community</b>
								</div>
							</div>

                            <div class="widget">
                                <h4 class="widget-title">Moderators</h4>
                                <ul class="followers">
                                    @foreach ($subreddit->moderators as $subs)
                                        <li>
                                            <figure><img src="{{asset('storage/'.$subs->image)}}" width="30px" alt=""></figure>
                                            <div class="friend-meta">
                                                <h4><a href="time-line.html" title="">{{$subs->name}}</a></h4>
                                                <a href="/homes/{{$subs->id}}" title="" class="underline">Go</a>
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
	</section>
@if ($sectionoff)
</section>
@endsection
@endif
