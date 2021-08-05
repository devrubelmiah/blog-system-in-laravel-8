<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;

class FavouriteController extends Controller
{
    
    public function index()
    {
        $posts = Auth::user()->favorite_posts;
        return view('admin.favorite', compact('posts'));
    }
}
