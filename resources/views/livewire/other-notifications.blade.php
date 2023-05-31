
<li>
    <a href="#" title="Notification" data-ripple="">
        <i class="fa fa-bell"></i>
            @if($check)
                @if($check['count'] != '0')
                <em class="bg-purple">
                    @if($check['count'] > 10)10+@else{{$check['count']}}@endif
                </em>
                @endif
            @endif

    </a>
    <div class="dropdowns">
        <span>@if($check['count'] > 10)10+ new notifications @else{{$check['count']}} new notifications @endif no notification</span>
        <ul class="drops-menu">
            @include('other.beybala',['includetopnotifications'=>'a'])

        </ul>
        <a href="/notifications/{{auth()->user()->id}}" title="" class="more-mesg">View All</a>
        <button style="display:none" wire:click="yenile" id="notificationRefresh"></button>
    </div>
</li>
