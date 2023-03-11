<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $query = Post::query();
        $index = $request->input('index');
        $posts = $query->where('title', 'LIKE', '%' . $index . '%')->get();
        return view('other.search-result',get_defined_vars());
    }
}
