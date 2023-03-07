<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subreddit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FIlterController extends Controller
{
    public function filter($id,$date) {
        $subreddit = Subreddit::find($id);
        $subreddits = Subreddit::withCount('users')->orderByDesc('users_count')->get();
        $deletedposts = DB::table('deletedposts')->where('subreddit_id',$subreddit->id)->get();
        $dpost = collect($deletedposts)->pluck('post_id');
        if($date === 'today'){
            $today = now()->today()->format('Y-m-d');
            $posts = Post::where('subreddit_id',$subreddit->id)->whereNotIn('id',$dpost)->whereBetween('created_at',[$today.' 00:00:00', $today.' 23:59:59'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
            $tudik = "";
        }elseif($date === 'week'){
            $today = now()->today()->format('Y-m-d');
            $week = now()->subWeek();
            $posts = Post::where('subreddit_id',$subreddit->id)->whereNotIn('id',$dpost)->whereBetween('created_at',[$week, $today.' 23:59:59'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
            $wedik = "";
        }
        elseif($date === 'month'){
            $today = now()->today()->format('Y-m-d');
            $month = now()->subMonth();
            $posts = Post::where('subreddit_id',$subreddit->id)->whereNotIn('id',$dpost)->whereBetween('created_at',[$month, $today.' 23:59:59'])
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
            $modik = "";

        }elseif($date === 'all'){
            $posts = Post::where('subreddit_id',$subreddit->id)->whereNotIn('id',$dpost)
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->get();
            $adik = "";

        }
        return view('other.subreddit',get_defined_vars());

    }
    public function createpost($id){
        $crotsubreddit = Subreddit::find($id);
        return view('other.postmake',get_defined_vars());
    }
}
