<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class AuthorController extends Controller
{
    public function profile($slug)
    {
        $author = User::where('username', $slug)->first();
        $posts  = $author->posts()->approved()->published()->get();
        return view('profile', compact('posts', 'author'));
    }
}
