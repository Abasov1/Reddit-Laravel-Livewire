@extends('layout.app')
@section('app')
@if (auth()->check())

    {{function(){ return view('other.home');}}}
@endif
    <form action="/register" enctype="multipart/form-data" method="post">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}"><br>
        @error('name')
            {{$message}}
        @enderror <br>
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email')
            {{$message}}
        @enderror <br>
        <input type="password" name="password" value="{{ old('password') }}"> <br>
        @error('password')
            {{$message}}
        @enderror <br>
        <input type="password" name="password_confirmation"><br><br>
        profil:
        <input type="file" name="image"><br>
        @error('image')
            {{$message}}
        @enderror <br>
        <input type="submit" value="qeydiyyatdan kec"><br>
    </form>
@endsection
