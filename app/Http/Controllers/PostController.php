<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts  = Post::latest()->approved()->published()->paginate(6);
        return view('posts', compact('posts'));
    }

    public function postByCategory($slug)
    {
        $category   = Category::where('slug', $slug)->first();
        $posts      = $category->posts()->approved()->published()->get();
        return view('category', compact('category', 'posts'));
    }

    public function postByTag($slug)
    {
        $tag   = Tag::where('slug', $slug)->first();
        $posts      = $tag->posts()->approved()->published()->get();
        return view('tag', compact('tag', 'posts'));  
    }

    public function postDetail($slug)
    {
        $post           = Post::where('slug', $slug)->approved()->published()->first();
        $randomPosts    = Post::approved()->published()->take(3)->inRandomOrder()->get();
        $blogKey        = 'blog_' . $post->id;
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }
        return view('single-post', compact('post', 'randomPosts'));
    }

}
