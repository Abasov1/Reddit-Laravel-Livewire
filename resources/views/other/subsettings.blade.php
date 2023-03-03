@extends('layout.temp')
@section('profile')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row merged20" id="page-contents">
                        <div class="col-lg-9">
                            <div class="featured-baner mate-black low-opacity">
                                @php
                                    $baner = explode('/',$subreddit->image);
                                @endphp
                                <img src="{{asset('storage/'.$baner[1])}}" alt="">
                                <h3>{{$subreddit->name}}</h3>
                            </div>
                            <div class="central-meta">
                                <div class="about">
                                    <div class="d-flex flex-row mt-2">
                                        <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" >
                                            <li class="nav-item">
                                                <a href="#gen-setting" class="nav-link active" data-toggle="tab" ><i class="fa fa-gear"></i>Moderators</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#edit-profile" class="nav-link" data-toggle="tab" ><i class="fa fa-pencil"></i> Edit Profile</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#notifi" class="nav-link" data-toggle="tab" ><i class="fa fa-bell"></i> Notification</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#messages" class="nav-link" data-toggle="tab" ><i class="fa fa-comment"></i> Messages</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#weather" class="nav-link" data-toggle="tab" ><i class="fa fa-cloud"></i> Weather Setting</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#page-manage" class="nav-link" data-toggle="tab" ><i class="fa fa-pencil-square-o"></i>Widgets Setting</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#privacy" class="nav-link" data-toggle="tab"  ><i class="fa fa-shield"></i> Privacy & Data</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#security" class="nav-link" data-toggle="tab" ><i class="fa fa-lock"></i> Security</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#apps" class="nav-link" data-toggle="tab" ><i class="fa fa-th"></i> Apps</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="gen-setting" >
                                                <div class="set-title">
                                                    <h5 id="qezenfer">Moderator settings</h5>
                                                    <h6>Moderators:</h6>
                                                    <div class="widget">
                                                        <ul class="followers" id="moderator-list">
                                                            @foreach ($subreddit->moderators as $moderator)
                                                                <li  style="margin-bottom:15px;">
                                                                    <figure><img src="{{asset('storage/'.$moderator->image)}}" width="30px" alt=""></figure>
                                                                    <div class="friend-meta">
                                                                        <h4><a href="time-line.html" title="">{{$moderator->name}}</a></h4>
                                                                        @if($moderator->isCreator($subreddit))
                                                                        <a href="/homes/{{$moderator->id}}"> Creator of this subreddit</a>
                                                                        @else
                                                                        <a href="#"  onclick="takemodrole({{$moderator->id}},{{$subreddit->id}});" title="" class="underline">Take moderator role</a>
                                                                        @endif
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                            @isset($requestedmods)
                                                                @foreach ($requestedmods as $moderator)
                                                                    <li  style="margin-bottom:15px;">
                                                                        <figure><img src="{{asset('storage/'.$moderator->image)}}" width="30px" alt=""></figure>
                                                                        <div class="friend-meta">
                                                                            <h4><a href="time-line.html" title="">{{$moderator->name}}</a></h4>
                                                                            @if($moderator->isCreator($subreddit))
                                                                            <a href="#"> Creator of this subreddit</a>
                                                                            @else
                                                                            <a href="#"  onclick="takemodrequest({{$moderator->id}},{{$subreddit->id}});" title="" class="underline">Mod request sended</a>
                                                                            @endif
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @endisset

                                                        </ul>

                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" data-toggle="modal" data-target="#myModal">Add moderator</button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content"  style="background-color:rgb(29,35,51)">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Enter User Name</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" id="text-input" class="form-control" style="background-color:rgb(40,46,62)" placeholder="Enter text here">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" style="background-color:rgb(36,49,82);border-color:rgb(36,49,82);color:white;" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" style="background-color:rgb(250,66,90);border-color:rgb(250,66,90);" onclick="submitText({{$subreddit->id}})">Submit</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                <div class="account-delete">
                                                    <h5>Subreddit changes</h5>
                                                    <div>
                                                        <span>Users cant post or join the subreddit</span>
                                                        <button type="button" class=""><span>Deactivate subreddit</span></button>
                                                    </div>
                                                    <div>
                                                        <span>Delete all posts and subreddit</span>
                                                        <button type="button" class=""><span>Delete subreddit</span></button>
                                                    </div>
                                                </div>
                                            </div><!-- general setting -->
                                            <div class="tab-pane fade" id="edit-profile" >
                                                <div class="set-title">
                                                    <h5>Edit Profile</h5>
                                                    <span>People on Pitnik will get to know you with the info below</span>
                                                </div>
                                                <div class="setting-meta">
                                                    <div class="change-photo">
                                                        <figure><img src="images/resources/admin2.jpg" alt=""></figure>
                                                        <div class="edit-img">
                                                            <form class="edit-phto">

                                                                <label class="fileContainer">
                                                                    <i class="fa fa-camera-retro"></i>
                                                                    Chage DP
                                                                <input type="file">
                                                                </label>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="stg-form-area"></div>
                                            </div><!-- edit profile -->
                                            <div class="tab-pane fade" id="notifi" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Notification Setting</h5>
                                                    <span>Select push and email notifications you'd like to receive.</span>
                                                </div>
                                                <div class="notifi-seting">
                                                    <div class="form-radio">
                                                      <div class="radio">
                                                        <label>
                                                          <input type="radio" checked="checked" name="radio"><i class="check-box"></i>
                                                            Send Me emails about my activity except emails i have unsubscribe from
                                                        </label>
                                                      </div>
                                                      <div class="radio">
                                                        <label>
                                                          <input type="radio" name="radio"><i class="check-box"></i>
                                                            Only send me required services announcements.
                                                        </label>
                                                      </div>
                                                    </div>
                                                    <div class="set-title">
                                                        <h6>i'd like to receive emails and updates from Pitnik about</h6>
                                                    </div>
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Always General announcement, updates, posts, and videos.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Personalise tips for my page.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Announcements and recommendations.
                                                      </label>
                                                        <p><a href="#" title="">learn more</a> about emails from pitnik</p>
                                                    </div>
                                                    <div class="set-title">
                                                        <h6>Other Notifications</h6>
                                                    </div>
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Recommended videos.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          activity on my page or channel.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Activity on my comments.
                                                      </label>
                                                        <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Reply to comments.
                                                      </label>
                                                        <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Mentions.
                                                      </label>

                                                    </div>
                                                    <div class="set-title">
                                                        <h6>Language Preference</h6>
                                                        <span>Select your email language</span>
                                                    </div>
                                                    <select class="select">
                                                        <option value="">Eglish US</option>
                                                        <option value="">Eglish UK</option>
                                                        <option value="">Russia</option>
                                                    </select>
                                                    <p>
                                                        you will always get notifications you have turned on for individual <a href="#" title="">Manage All Subscriptions</a>
                                                    </p>
                                                </div>
                                            </div><!-- notification -->
                                            <div class="tab-pane fade" id="messages" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Messages Setting</h5>
                                                    <span>Set your login preference, help us personalize your experience and make big account change here.</span>
                                                    <div class="mesg-seting">

                                                    <div class="set-title">
                                                        <h6>i'd like to receive emails and updates from Pitnik about</h6>
                                                    </div>
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Always General announcement, updates, posts, and videos.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Personalise tips for my page.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Announcements and recommendations.
                                                      </label>
                                                        <p><a href="#" title="">learn more</a> about emails from pitnik</p>
                                                    </div>
                                                    <div class="set-title">
                                                        <h6>Other Messages</h6>
                                                    </div>
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          From Recommended videos.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Messages from activity on my page or channel.
                                                      </label>
                                                      <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Message me the replyer Activity on my comments.
                                                      </label>
                                                        <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Reply to comments.
                                                      </label>
                                                        <label>
                                                        <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                          Mentions.
                                                      </label>

                                                    </div>
                                                    <div class="set-title">
                                                        <h6>Language Preference</h6>
                                                        <span>Select your Messages language</span>
                                                    </div>
                                                    <select class="select">
                                                        <option value="">Eglish US</option>
                                                        <option value="">Eglish UK</option>
                                                        <option value="">Russia</option>
                                                    </select>
                                                    <p>
                                                        you will always get notifications you have turned on for individual <a href="#" title="">Manage All Subscriptions</a>
                                                    </p>
                                                </div>
                                                </div>
                                            </div><!-- messages -->
                                            <div class="tab-pane fade" id="weather" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Weather Widget Setting</h5>
                                                    <span>Set your weather widget or page setting.</span>
                                                    <div class="mesg-seting">
                                                        <div class="set-title">
                                                            <h6>Country & Timezone</h6>
                                                            <span>Select your Country Time Zone</span>
                                                        </div>
                                                        <select class="select">
                                                            <option value="">US (UTC-8)</option>
                                                            <option value="">Ontario(UTC-7)</option>
                                                            <option value="">Nova Scotia(UTC-5)</option>
                                                        </select>
                                                        <div class="set-title">
                                                            <h6>Temperature Unit</h6>
                                                        </div>
                                                        <select class="select">
                                                            <option value="">F° (Farenheit)</option>
                                                            <option value="">C° (Celsius)</option>
                                                        </select>
                                                        <div class="set-title">
                                                            <h6>Show Extended forecast</h6>
                                                        </div>
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" checked="checked"><i class="check-box"></i>
                                                              Show Extended Forecast on Widget.
                                                          </label>
                                                            <p><a href="#" title="">learn more</a></p>
                                                        </div>
                                                        <div class="set-title">
                                                            <h6>Forecast Days</h6>
                                                        </div>
                                                        <select class="select">
                                                            <option value="">Next Day</option>
                                                            <option value="">Next week</option>
                                                            <option value="">Next Month</option>
                                                            <option value="">Next Year</option>
                                                        </select>
                                                        <p>
                                                            you will always get Daily notifications you have turned on for individual.
                                                        </p>
                                                        <div>
                                                        <form>
                                                            <button class="main-btn" data-ripple="" type="submit">Save</button>
                                                            <button class="main-btn3" data-ripple="" type="submit">Cancel</button>

                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- weather widget setting -->
                                            <div class="tab-pane fade" id="page-manage" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Page & sidebar</h5>
                                                    <span>Deceide whether your profile will be hidden from search engine and what kind of data you want to use to imporve the recommendation and ads you see <a href="#" title="">Learn more</a></span>
                                                </div>
                                                <p class="p-info"><a href="manage-page.html">Click here</a> to go widget and page setting area</p>
                                            </div><!-- privacy -->
                                            <div class="tab-pane fade" id="privacy" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Privacy & data</h5>
                                                    <span>Deceide whether your profile will be hidden from search engine and what kind of data you want to use to imporve the recommendation and ads you see <a href="#" title="">Learn more</a></span>
                                                </div>
                                                <div class="onoff-options ">
                                                    <form method="post">
                                                        <div class="setting-row">
                                                            <span>Search Privacy</span>
                                                            <p>Hide your profile from search engine (Ex.google) <a href="#" title="">Learn more</a>
                                                            </p>
                                                            <input type="checkbox" id="switch0001" />
                                                            <label for="switch0001" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                        <div class="set-title">
                                                            <h5>Personalization</h5>
                                                        </div>
                                                        <div class="setting-row">
                                                            <span>Search Privacy</span>
                                                            <p>use sites you visit to improve which recommendation and ads you see. <a href="#" title="">Learn more</a>
                                                            </p>
                                                            <input type="checkbox" id="switch0002" />
                                                            <label for="switch0002" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                        <div class="setting-row">
                                                            <span>Search Privacy</span>
                                                            <p>use information from our partners to improve which ads you see<a href="#" title="">Learn more</a>
                                                            </p>
                                                            <input type="checkbox" id="switch0003" />
                                                            <label for="switch0003" data-on-label="ON" data-off-label="OFF"></label>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- privacy -->
                                            <div class="tab-pane fade" id="security" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Security Setting</h5>
                                                    <span>trun on two factor authentication and check your list of connected device to keep your account posts safe <a href="#" title="">Learn More</a>.</span>
                                                </div>
                                                <div class="seting-box">
                                                    <p>to turn on two-factor authentication, you must <a href="#" title=""> confirm Your Email </a> and <a href="#" title="">Set Password</a></p>
                                                    <div class="set-title">
                                                        <h5>Connected Devicese</h5>
                                                    </div>
                                                    <p>This is a list of devices that have logged into your account, Revok any session that you do not recognize. <a href="#" title="">Hide Sessions</a></p>
                                                    <span>Last Accessed</span>
                                                    <p>August 30, 2020 12:25AM</p>
                                                    <span>Location</span>
                                                    <p>Berlin, Germany (based on IP = 103.233.24.5)</p>
                                                    <span>Device Type</span>
                                                    <p>Chrome on windows 10</p>
                                                </div>
                                            </div><!-- security -->
                                            <div class="tab-pane fade" id="apps" role="tabpanel">
                                                <div class="set-title">
                                                    <h5>Apps</h5>
                                                    <span>Keep track of everywhere you have login with your pintik profile and remove access from apps you are no longer using with pitnik <a href="#" title="">Learn more</a></span>
                                                </div>
                                                <p class="p-info">You have not approved any app</p>
                                            </div><!-- apps -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- centerl meta -->
                        <div class="col-lg-3">
                            <aside class="sidebar static right">
                                <div class="friend-box" >
                                    <figure>
                                        @php
                                            $baner = explode('/',$subreddit->image);
                                        @endphp
                                        <img alt="" src="{{asset('storage/'.$baner[0])}}">
                                        <span>{{$subreddit->users->count()}}</span>
                                    </figure>
                                    <div class="frnd-meta" >
                                        <img alt="" src="images/resources/frnd-figure3.jpg">
                                        <div style="display:flex;justify-content:center;">
                                            <h5><a title="" href="#" style="color:white;">{{$subreddit->name}}</a></h5>
                                        </div>
                                    </div>
                                    <div style="display:flex;justify-content:center;">
                                    <b>About this community</b>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
