<div>
<span>@if($frrequests) {{$count}} new request @endisset</span>
<ul class="drops-menu">
        @foreach ($frrequests as $i=>$friend)
            <li>
                <div>
                    <div class="comet-avatar user-image-container">
                        <img wire:click="accept({{$friend->id}})" src="{{asset('storage/'.$friend->user->image)}}" alt="">
                    </div>
                    <div class="mesg-meta">
                        <h6><a href="#" title="">{{$friend->user->name}}</a></h6>
                        <span>{{$friend->date->diffForHumans()}}</span>
                        <i></i>
                    </div>
                    <div class="add-del-friends">
                        <label wire:click="accept({{$friend->user->id}})" title="Accept"><i class="fa fa-check"></i></label>
                        <label wire:click="ignore({{$friend->user->id}})" title="Ignore"><i class="fa fa-trash"></i></label>
                    </div>
                </div>
            </li>
        @endforeach
        @if ($count == '0')
            <div class="mesg-meta" style="padding:20px;">
                <h6><a href="#" title="">You dont have any friend requests</a></h6>
                <i></i>
            </div>
        @endif
</ul>
</div>
