<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FilterSubreddit extends Component
{
    public $subreddit;
    public $posts;
    public $dpost;
    public $today;
    public $gayliy;
    public $empty = false;
    protected $listeners = [
        'filt'=>'filt',
        'new' => 'loadNew',
        'today' => 'loadToday',
        'week' => 'loadWeek',
        'month' => 'loadMonth',
        'all' => 'loadAll'
    ];
    public function mount($subreddit){
        $this->subreddit = $subreddit;
        $this->today = now()->today()->format('Y-m-d');
        $deletedposts = DB::table('deletedposts')->where('subreddit_id',$subreddit->id)->get();
        $this->dpost = collect($deletedposts)->pluck('post_id');
        $this->loadNew();

    }
    public function loadNew(){
        $this->posts = Post::where('subreddit_id',$this->subreddit->id)->whereNotIn('id',$this->dpost)->latest()->get();
        if($this->posts->isEmpty()){
            $this->empty = true;
        }
    }
    public function loadToday(){
        $this->posts = Post::where('subreddit_id',$this->subreddit->id)
            ->whereNotIn('id',$this->dpost)
            ->whereBetween('created_at',[$this->today.' 00:00:00', $this->today.' 23:59:59'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
        if($this->posts->isEmpty()){
            $this->empty = true;
        }
    }
    public function loadWeek(){
        $week = now()->subWeek();
        $this->posts = Post::where('subreddit_id',$this->subreddit->id)
            ->whereNotIn('id',$this->dpost)
            ->whereBetween('created_at',[$week, $this->today.' 23:59:59'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
        if($this->posts->isEmpty()){
            $this->empty = true;
        }
    }
    public function loadMonth(){
        $month = now()->subMonth();
        $this->posts = Post::where('subreddit_id',$this->subreddit->id)
            ->whereNotIn('id',$this->dpost)
            ->whereBetween('created_at',[$month, $this->today.' 23:59:59'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
        if($this->posts->isEmpty()){
            $this->empty = true;
        }
    }
    public function loadAll(){
        $this->posts = Post::where('subreddit_id',$this->subreddit->id)
            ->whereNotIn('id',$this->dpost)
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
        if($this->posts->isEmpty()){
            $this->empty = true;
        }

    }
    public function filt(){
        dd('sevil peyserdi');
    }
    public function render()
    {
        return view('livewire.filter-subreddit');
    }
}
