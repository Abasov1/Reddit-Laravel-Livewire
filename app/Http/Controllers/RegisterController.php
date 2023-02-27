<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use League\Flysystem\FilesystemOperationFailed;
use Nette\Utils\FileSystem;



class RegisterController extends Controller
{
    public function index(){
        $users = User::get();
        $subreddits = Subreddit::get();
        $posts = Post::get();
        return view('auth.register',get_defined_vars());
    }

    public function store(Request $request){
        if($request->hasFile('image')){
            $image = Image::make($request->file('image'));

            // crop the image to a square
            $image->fit(300, 300);

            $ex = $request->file('image')->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $folderPath = "storage/images/";
            $image->save(public_path('storage/' .$file));

        }

        $validated = $request->validate([
            'name' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|max:255|unique:users',
            'image' =>'required',
    ]);
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'image' => $file
        ]);
        if(!auth()->attempt($request->only('email','password'))){
            return back();
        }
        return redirect('/homes');
    }
}
