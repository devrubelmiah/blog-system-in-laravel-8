<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', "%$query%")->published()->approved()->get();
        return view('search', compact('posts', 'query'));
    }
}
