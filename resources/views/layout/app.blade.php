<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
	src="https://code.jquery.com/jquery-3.6.3.js"
	integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
	crossorigin="anonymous"></script>

</head>
<body>

@auth
    <a href="/homes">HOME</a>
    <a href="/post">make post</a>
    <a href="/logout">LOGOUT</a>
    <b>{{auth()->user()->name}}</b> - <img src="{{asset('storage/'.auth()->user()->image)}}" width="40px" height="30px">
@endauth
@guest
    <a href="/login">LOGin</a>
    <a href="/register">REegister</a>
@endguest


    @yield('app')
</body>
</html>
