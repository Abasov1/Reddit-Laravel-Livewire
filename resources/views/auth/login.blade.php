@extends('layout.app')
@section('app')
    <form action="/login" method="post">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email')
            {{$message}}
        @enderror <br>
        <input type="password" name="password" value="{{ old('password') }}"> <br>
        @error('password')
            {{$message}}
        @enderror <br>
        Xatirla meni
        <input type="checkbox" name="remember" id="remember"><br>
        <input type="submit" value="daxil ol"><br>
    </form>
@endsection
