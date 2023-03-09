<?php

namespace App\Http\Livewire;

use App\Models\Notificationsetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class LiveUserSettings extends Component
{
    use WithFileUploads;
    public $user;
    public $nt;
    public $frnt;
    public $modnt;
    public $postnt;
    public $allnt;
    public $confirmated = false;
    public $name;
    public $email;
    public $image;
    public $password;
    public $conerror = 'false';
    public function mount(){
        $this->user = auth()->user();
        $this->nt = Notificationsetting::where('user_id',$this->user->id)->first();
        $this->frnt = $this->nt->frnt;
        $this->modnt = $this->nt->modnt;
        $this->postnt = $this->nt->postnt;
        $this->allnt = $this->nt->allnt;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }
    public function rules(){
        return [
            'name' => [
                'required',
                'min:6',
                'max:20',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => 'required|min:6|max:25'
        ];
    }
    public function dd(){
        dd($this->image);
    }
    public function setsettings(){
        $this->user->ntsetting()->update([
            'frnt' => $this->frnt,
            'modnt' => $this->modnt,
            'postnt' => $this->postnt,
            'allnt' => $this->allnt,
        ]);
    }
    public function dsall(){
        if($this->allnt == true){
            $this->frnt = false;
            $this->modnt = false;
            $this->postnt = false;
        }else{
            $this->frnt = true;
            $this->modnt = true;
            $this->postnt = true;
        }
    }
    public function cancel(){
        $this->frnt = $this->nt->frnt;
        $this->modnt = $this->nt->modnt;
        $this->postnt = $this->nt->postnt;
        $this->allnt = $this->nt->allnt;
    }
    public function dsds(){
        $this->allnt = false;
        if($this->frnt == false && $this->modnt == false && $this->postnt == false){
            $this->allnt = true;
        }
    }
    public function confirmate(){
        if(Hash::check($this->password, $this->user->password)){
            $this->conerror = 'c';
            $this->confirmated = true;
        }else{
            $this->conerror = 'd';
        }
    }
    public function save(){
        $this->validate();
        if($this->image != $this->user->image){
            if($this->image != 'default.jpg'){
                Storage::disk('public')->delete($this->user->image);
            }
            $image = Image::make($this->image);

            // crop the image to a square
            $image->fit(300, 300);

            $ex = $this->image->getClientOriginalExtension();
            $file = uniqid() .'.'. $ex;
            $image->save(public_path('storage/' .$file));
            $this->user->update([
                'image' => $file
            ]);
        }
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
        return redirect('settings/'.$this->user->id);
    }
    public function resett(){
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->image = null;
    }
    public function validateField($field){
        $this->validateOnly($field);
    }
    public function updated($field){
        $this->validateField($field);
    }
    public function render()
    {
        return view('livewire.live-user-settings');
    }
}
