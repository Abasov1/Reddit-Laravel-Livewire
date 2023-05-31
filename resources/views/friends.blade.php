@extends('layout.temp')
@section('friends')
	<section id="content">
		<div class="gap2 gray-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="row merged20" id="page-contents">
							<div class="user-profile">
								<figure>
									<img src="{{url('images/resources/profile-image.jpg')}}" alt="">
									@if(auth()->user()->id != $uqar->id)
                                    <ul class="profile-controls">
                                        @if(!$uqar->isFriend())
                                        <form action="/add/{{$uqar->id}}" method="post">
                                            @csrf
                                            <button type="submit" id="uqarsend" style="display:none"></button>
                                            <li><label for="uqarsend" ><i class="fa fa-user-plus"></i></label></li>
                                        </form>
                                        @else
                                        <form action="/leavefriendship/{{$uqar->id}}" method="post">
                                            @csrf
                                            <button type="submit" id="qutar" style="display:none"></button>
                                            <li><label for="qutar" title="Finish friendship"><i class="fa fa-trash"></i></label></li>
                                        </form>
                                        @endif
                                        {{-- <form action="/add/{{$uqar->id}}" method="post">
                                            @csrf
                                            <button type="submit" id="uqarsend" style="display:none"></button>
                                            <li><label for="" ><a href="#" title="Add friend" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></label></li>
                                        </form>                                      --}}
                                    </ul>
                                    @endif
								</figure>

								<div class="profile-section">
									<div class="row">
										<div class="col-lg-2 col-md-3">
											<div class="profile-author">
												<a class="profile-author-thumb" href="about.html">
													<img alt="author" src="{{asset('storage/'.$uqar->image)}}">
												</a>
												<div class="author-content">
													<a class="h4 author-name" href="about.html">{{$uqar->name}}</a>
													<div class="country">Ontario, CA</div>
												</div>
											</div>
										</div>
										<div class="col-lg-10 col-md-9">
											<ul class="profile-menu">
												<li>
													<a class="" href="/homes/{{$uqar->id}}">Posts</a>
												</li>
												<li>
													<a class="active" href="/friends/{{$uqar->id}}">Friends</a>
												</li>

												@if($user->id === auth()->user()->id)
                                                <li>
                                                    <a class="" href="/settings/{{$user->id}}">Settings</a>
                                                </li>
                                                @endif
											</ul>
										</div>
									</div>
								</div>
							</div><!-- user profile banner  -->
							<div class="col-lg-12">
								<div class="central-meta padding30">
									<div class="row">
                                        @foreach ($friends as $friend)
										<div class="col-lg-3 col-md-6 col-sm-6">
											<div class="friend-box">
												<div class="frnd-meta">
                                                    <div class="pimage-container">
													    <img src="{{asset('storage/'.$friend->image)}}" alt="">
                                                    </div>
													<div class="frnd-name">
														<a href="#" title="">{{$friend->name}}</a>
														<span>California, USA</span>
													</div>
													<ul class="frnd-info">
														<li><span>Friends:</span> {{$friend->friendcount()}}</li>
														<li><span>Subsss: </span>{{$friend->createdSubredditsCount()}}</li>
														<li><span>Posts:</span>{{$friend->posts->count()}}</li>
														<li><span>Since:</span> {{$friend->addedAt($uqar)}}</li>
													</ul>
													<div class="more-opotnz">
														<i class="fa fa-ellipsis-h"></i>
														<ul>
                                                            <div>
                                                                <form action="/leavefriendship/{{$friend->id}}" method="post">
                                                                    @csrf
                                                                    <button type="submit" style="display:none" id="{{'leavefriendship'.$friend->id}}"></button>
                                                                    <li><label for="{{'leavefriendship'.$friend->id}}">End friendship</label></li>
                                                                </form>
	                                                        </div>
														</ul>
													</div>
												</div>
											</div>
										</div>
                                        @endforeach

									</div>
                                    @if ($friends->isEmpty())
                                        <div class="lodmore">
                                            @if ($user->id === auth()->user()->id)
                                                <span>You have no friends</span>
                                            @else
                                                <span>{{$uqar->name}} have no friends</span>
                                            @endif

                                        </div>
                                    @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- content -->

@endsection
