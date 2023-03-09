<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class AuthLive extends Component
{
    use WithFileUploads;
    public $image = false;
    public $rname;
    public $remail;
    public $rpassword;
    public $rpasswordConfirmation;
    public $lemail;
    public $lpassword;
    public $remember;
    public $qirir;
    public function rules(){
        return [
            'rname' => 'required|min:6|max:20|unique:users,name',
            'remail' => 'required|email|unique:users,email',
            'rpassword' => 'required|min:6|max:20',
            'rpasswordConfirmation' => 'required|same:rpassword',
            'lemail' => 'required|email|exists:users,email',
            'lpassword' => 'required',
        ];
    }
    public function messages(){
        return [
            'rname.required' => 'Name is required',
            'rname.min' => 'Name should be at least 6 characters',
            'rname.max' => 'Name should be maximum 20 characters',
            'remail.required' => 'Email is required',
            'remail.email' => 'It should be an email',
            'remail.unique' => 'This email has already taken',
            'rpassword.required' => 'Password is required',
            'rpasswordConfirmation.same' => 'Password confirmation is not match',
            'rpasswordConfirmation.required' => 'Password confirmation is required',
            'rpassword.min' => 'Password should be at least 6 characters',
            'rpassword.max' => 'Password should be maximum 20 characters',
            'lemail.required' => 'Email is required',
            'lemail.email' => 'It should be an email',
            'lemail.exists' => 'This email never logged in',
            'lpassword.required' => 'Password is required'
        ];
    }
    public function register(){
        $this->validate([
            'rname' => 'required|min:6|max:20|unique:users,name',
            'remail' => 'required|email|unique:users,email',
            'rpassword' => 'required|min:6|max:20',
            'rpasswordConfirmation' => 'required|same:rpassword',
        ]);
        if($this->image != false){
            $image = Image::make($this->image);
            $image->fit(300, 300);
            $ex = $this->image->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $image->save(public_path('storage/' .$file));
        }else{
            $file = 'default.jpg';
        }

        $user = User::create([
            'name' => $this->rname,
            'password' => Hash::make($this->rpassword),
            'email' => $this->remail,
            'image' => $file
        ]);
        $user->ntsetting()->create([
            'frnt' => true,
            'modnt' => true,
            'postnt' => true,
            'allnt' => false,
        ]);
        if(!auth()->attempt(['email'=>$this->remail,'password'=>$this->rpassword])){
            return back();
        }
        return redirect('/homes');
    }
    public function login(){
        $this->validate([
            'lemail' => 'required|email|exists:users,email',
            'lpassword' => 'required',
        ]);
        if(!auth()->attempt(['email'=>$this->lemail,'password'=>$this->lpassword],$this->remember)){
            $this->qirir = 'Password is wrong';
        }else{
            return redirect('/homes');
        }
    }
    public function dd(){
        dd($this->image);
    }
    public function validateField($field){
        $this->qirir = false;
        if($field === 'rpassword'){
            $this->validate([
                'rpassword' => 'required|min:6|max:20',
                'rpasswordConfirmation' => 'required|same:rpassword'
            ],);
        }
        $this->validateOnly($field);
    }
    public function updated($field){
        $this->validateField($field);
    }
    public function render()
    {
        return view('livewire.auth-live');
    }
}
