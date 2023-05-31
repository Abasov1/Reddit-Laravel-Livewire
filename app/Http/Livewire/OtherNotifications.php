<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OtherNotifications extends Component
{
    public $check;
    protected $listeners = ['refreshNotification'=>'yenile'];
    public function mount(){
        $usar = auth()->user();
        $this->check = $usar->checkNotifications();
    }
    public function yenile(){
        $usar = auth()->user();
        $this->check = $usar->checkNotifications();
    }
    public function render()
    {
        return view('livewire.other-notifications');
    }
}
