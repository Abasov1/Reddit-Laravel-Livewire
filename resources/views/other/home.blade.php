@extends('layout.temp')
@section('subreddit')
<section>
    <div class="gap2 gray-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <div id="variable-list">
                    @foreach ($posts as $post)
                        @include('other.post')
                    @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar static right">
                        <div class="friend-box" >
                            <figure>
                                <img alt="" src="https://media.tenor.com/n9lJJHKNWkgAAAAM/motion-illusion.gif">
                            </figure>
                            <div class="frnd-meta" >
                                <div style="display:flex;justify-content:center;">
                                    <a title="" href="#">Welcome to StepReddit</a>
                                </div>
                                <a class="main-btn2" href="/post">Create post</a>
                                <a class="main-btn2" href="/post">Create subreddit</a>
                            </div>
                            <div style="display:flex;justify-content:center; padding:10px;" >
                            <p>StepReddit is platform that gives you acces to create substepreddits and publish posts. Just make sure that you are not stepping the rules</p>
                            </div>
                        </div>

                        <div class="widget">
                            <ul class="followers" style="padding-top:20px;">
                                @2022 all right's deserved
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
