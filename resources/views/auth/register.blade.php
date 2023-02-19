@extends('layout.app')
@section('app')

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
        <input type="file" name="image" id="image" onchange="readURL(this);"><br>
        @error('image')
            {{$message}}
        @enderror <br>
        <input type="submit" value="qeydiyyatdan kec"><br>
    </form>
    <img id="blah" src="http://placehold.it/180"  width="100px" height="auto"/> <br>
    <script>
        $('#blah').hide();
            $('#negar').show();
            $('#yourmom').hide();
             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $('#blah').show();
                $('#negar').hide();
                $('#yourmom').show();
            }
        }
    </script>
@endsection
