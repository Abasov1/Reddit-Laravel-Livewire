<div class="col-lg-7 col-md-6 ">
    <div class="logout-f" id="login" wire:ignore.self>
        <h4 wire:click="dd"> <i class="fa fa-key"></i> Login</h4>
        <p wire:click="dd">Wanna try something different from observing then login </p>
        <div class="logout-form">
            <form wire:submit.prevent="login" class="again-login">
                @csrf
                <input wire:model.lazy="lemail" required name="email" type="email" placeholder="Email" value="{{old('email')}}">
                @error('lemail')
                    <b style="text-color:red;color:red;margin-left:10px">{{$message}}</b>
                @enderror
                <input  wire:model="lpassword" required name="password" type="password" placeholder="Password" value="{{old('password')}}">
                @error('lpassword')
                    <b style="text-color:red;color:red;margin-left:10px">{{$message}}</b> <br
                @enderror
                @if($qirir)
                    <b style="text-color:red;color:red;margin-left:10px">{{$qirir}}</b> <br>
                @endif
                <label for="remember" id="remember-label">Remember me</label>
                <input wire:model="remember" type="checkbox" name="remember" style="display:inline-block" id="remember" {{ old('remember') ? 'checked' : '' }}><br>
                <button type="submit">Login</button>
            </form>
            <p>Don t have account? <a href="#" onclick="register(event);" title="">Register</a></p>
        </div>
    </div>
    <div class="logout-f" id="register" style="display:none;" wire:ignore.self>
        <h4><i class="fa fa-key"></i> Register</h4>
        <p>Create new inspiring profile</p>
        <div class="logout-form">
            <figure><img id="pp" src="{{ ($image != false) ? $image->temporaryUrl() : asset('storage/default.jpg')  }}" style="max-width:40px;max-height:40px;" alt=""></figure>
            <label class="fileContainer" id="atvuran" @error('image') style="color:red;" @enderror>
                <i class="fa fa-camera-retro"></i>
                Chage PP
            </label>
            <form wire:submit.prevent="register" class="again-login" enctype="multipart/form-data">
                @csrf
                <input wire:model.lazy="rname" required name="name" type="text" placeholder="Name" value="{{old('name')}}">
                @error('rname')
                    <b style="text-color:red;color:red;margin-left:10px">{{$message}}</b>
                @enderror
                <input wire:model.lazy="remail" required name="email" type="email" placeholder="Email" value="{{old('email')}}">
                @error('remail')
                    <b style="text-color:red;color:red;margin-left:10px">{{$message}}</b>
                @enderror
                <input wire:model.debounce.500ms="rpassword" required name="password" type="password" placeholder="Password" value="{{old('password')}}">
                @error('rpassword')
                    <b style="text-color:red;color:red;margin-left:10px">{{$message}}</b>
                @enderror
                <input wire:model="image" type="file" id="sendikr" style="display:none">
                <input wire:model="rpasswordConfirmation" required name="password_confirmation" type="password" placeholder="Password Confirmation">
                @error('rpasswordConfirmation')
                    <b style="text-color:red;color:red;margin-left:10px">{{$message}}</b>
                @enderror
                <button wire:loading.attr="disabled" type="submit" style="margin-left:10 px">Register</button>
            </form>
            <p>Already have a account? <a href="#" onclick="login(event);" title="">Login</a></p>
        </div>
    </div>
</div>
