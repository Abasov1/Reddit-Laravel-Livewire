<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $gayliy;
    protected $listeners = ['abi'=>'abi'];
    public function abi(){
        dd($this->gayliy);
    }
    public function render()
    {
        return view('livewire.test');
    }
}
