<li>
    <a href="#" title="Friend Requests" data-ripple="" id="friendrequestcount">
    <i class="fa fa-user"></i>

        @if($frrequests['count'] != '0')
                <em class="bg-red" id="frrqbt">
                {{$frrequests['count']}}
            </em>
            @endisset
    </a>
    <div class="dropdowns" id="frienddropdown">
        <span>@if($frrequests) {{$frrequests['count']}} new request @endisset</span>
        <ul class="drops-menu">
            @if ($frrequests['count'] != '0')
                @foreach ($frrequests['requests'] as $i=>$friend)
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
                @else
                <div class="mesg-meta" style="padding:20px;">
                <h6><a href="#" title="">You dont have any friend requests</a></h6>
                <i></i>
            </div>
                @endif
        </ul>
    </div>
</li>
