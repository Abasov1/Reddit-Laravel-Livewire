<div class="tab-content" wire:ignore.self>
    <div  wire:ignore.self class="tab-pane fade  @isset($editselected)@else @if ($errors->any())@else show active @endif @endisset" id="gen-setting" >
        <div class="set-title">
            <h5 wire:click="dd">Notification Setting</h5>
            <span>Let us know when should we send you message.</span>
        </div>
        <div class="onoff-options ">
            <form wire:submit.prevent="setsettings">
                <div class="setting-row">
                    <span>Friend requests</span>
                    <p>Enable this if you want to see friend request</p>
                    <input wire:loading.attr="disabled" wire:click="dsds" wire:model="frnt" type="checkbox" id="switch00" {{ ($nt->frnt == true) ? 'checked' : '' }} />
                    <label for="switch00" data-on-label="ON" data-off-label="OFF"></label>
                </div>
                <div class="setting-row">
                    <span>Mod requests</span>
                    <p>Enable this if you want people to send you mod request</p>
                    <input wire:loading.attr="disabled" wire:click="dsds" wire:model="modnt"  type="checkbox" id="switch01" {{ ($nt->modnt == true) ? 'checked' : '' }} />
                    <label for="switch01" data-on-label="ON" data-off-label="OFF"></label>
                </div>
                <div class="setting-row">
                    <span>Post notifications</span>
                    <p>Enable this if you want to see post notifications(like,comment,etc)</p>
                    <input wire:loading.attr="disabled" wire:click="dsds" wire:model="postnt"  type="checkbox" id="switch02" {{ ($nt->postnt == true) ? 'checked' : '' }} />
                    <label for="switch02" data-on-label="ON" data-off-label="OFF"></label>
                </div>
                <div class="setting-row">
                    <span>Disable all notifications</span>
                    <p>Disable all of them and live peaceful day</p>
                    <input wire:loading.attr="disabled" wire:click="dsall" wire:model="allnt"  type="checkbox" id="switch05" {{ ($nt->allnt == true) ? 'checked' : '' }}/>
                    <label for="switch05" data-on-label="ON" data-off-label="OFF"></label>
                </div>

                <div class="submit-btns">
                    <button type="submit" class="main-btn" data-ripple=""><span>Save</span></button>
                    <button type="button" wire:click="cancel" class="main-btn3" data-ripple=""><span>Cancel</span></button>
                </div>
            </form>
        </div>
        <div class="account-delete">
            <h5>Account Changes</h5>
            <div>
                <span>Hide Your Posts and profile </span>
                <button type="button" class=""><span>Deactivate account</span></button>
            </div>
            <div>
                <span>Delete your account and data </span>
                <button type="button" class=""><span>close account</span></button>
            </div>
        </div>
    </div><!-- general setting -->
    <div  wire:ignore.self class="tab-pane fade @isset($editselected)show active @endisset @if ($errors->any()) show active @endif" id="edit-profile" >
        <div class="set-title">
            <h5>Edit Profile</h5>
            <span>People on Pitnik will get to know you with the info below</span>
        </div>
        <div class="setting-meta">
            <div class="change-photo">
                <figure><img id="pp" src="{{ isset($image) ? $image->temporaryUrl() : asset('storage/'.$user->image) }}" style="max-width:40px;max-height:40px;" alt=""></figure>
                {{-- <div class="edit-img"> --}}

                        <label class="fileContainer" id="atvuran" @error('image') style="color:red;" @enderror>
                            <i class="fa fa-camera-retro"></i>
                            Chage PP
                        </label>

                {{-- </div> --}}
            </div>
        </div>
        <div class="stg-form-area">
            <form method="post" enctype="multipart/form-data" class="c-form" wire:submit.prevent="save">
                @csrf
                @method('PUT')
                <div>
                    <label>Name</label>
                    <input wire:model="name" type="text" name="name" value="{{$user->name}}">
                    @error('name')
                        <span style="color:red;">{{$message}}</span>
                    @enderror
                </div>
                <div>
                    <label>Email Address</label>
                    <input wire:model="email" type="email" name="email" value="{{$user->email}}">
                    @error('email')
                        <span style="color:red;">{{$message}}</span>
                    @enderror
                </div>
                <input wire:model="image" type='file' name="image" id="sendikr" onchange="previewImage('sendikr','pp')"  accept=".png, .jpg, .jpeg, .jfif" />
                <div>
                    <label id="newtext">Password - <span wire:model="conerror" id="message" style="margin-top:10px;@if($conerror === 'c')color:green;@elseif($conerror === 'd')color:red;@endif">@if($conerror === 'c')Confirmated @elseif($conerror === 'd')Password is not correct @endif</span></label>
                    <input wire:model="password" type="password" id="password" placeholder="First confrimate your password">
                    @if($confirmated)
                        @error('password')
                            <span style="color:red;">{{$message}}</span>
                        @enderror
                    @else
                    @endif
                </div>
                <div id="afterconfirmate">
                    <button wire:click="confirmate" type="{{($confirmated) ? 'submit' : 'button'}}" data-ripple="">{{ ($confirmated) ? 'Save' : 'Confirmate'}}</button>
                    <button wire:click="resett" type="button" data-ripple="">Reset</button>
                </div>

            </form>
        </div>
</div>
