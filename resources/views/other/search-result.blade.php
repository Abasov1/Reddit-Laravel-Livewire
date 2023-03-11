@extends('layout.temp')
@section('subreddit')
<section>
    <div class="gap2 gray-bg" style="min-height:600px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @livewire('search-live',['posts'=>$posts,'index'=>$index])
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
