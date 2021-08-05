<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewPostApproved;
use App\Notifications\NewPostNotify;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request,  [
            'title'         => 'required',
            'image'         => 'required|mimes:jpeg,jpg,png,gift,bmp',
            'categories'    => 'required',
            'tags'          => 'required',
            'body'          => 'required',
        ]);

        $image      = $request->file('image');
        $slug       = Str::slug($request->title).'-'.time();
        if ( isset($image) ) {
            $current_date = Carbon::now()->toDateString();        
            $imageName  = $current_date. '.'. uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('post') ) {
                Storage::disk("public")->makeDirectory('post');
            }
            $request->image->storeAs('/public/post/', $imageName);
        } else {
            $imageName = 'default.png';
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if (isset($request->status)) {
        $post->status = true;
        } else {
            $request->status = false;
        }
        $post->is_approved = true;
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $subscribes = Subscribe::all();
            foreach ( $subscribes as $key => $subscribe ) {
                Notification::route('mail', $subscribe->email )
                ->notify(new NewPostNotify($post));
            }

        Toastr::success("Post successfully save..)", 'Success');
        return redirect()->route('admin.post.index');
    }

    public function approval($id)
    {
        $post = Post::findOrfail($id);
        if ($post->is_approved == false) {
            $post->is_approved = true;
            $post->save();
            $post->user(new NewPostApproved($post));
            $subscribes = Subscribe::all();
            foreach ($subscribes as $key => $subscribe) {
                Notification::route('mail',$subscribe->email)
                ->notify(new NewPostNotify($post));
            }
            Toastr::success("Post successfully approved..)", 'Success');
        }else {
            Toastr::success("Post already is approved.....)", 'Success');
        }
        return redirect()->back();
    }

    public function pending()
    {
        $posts = Post::where('is_approved', false)->get();
        return view('admin.post.pending', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $post = Post::findOrfail($id);
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $categories     = Category::all();
        $tags           = Tag::all();
        $post           = Post::find($id);
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request,  [
            'title'      => 'required',
            'image'      => 'image',
            'categories' => 'required',
            'tags'       => 'required',
            'body'       => 'required',
        ]);

        $image      = $request->file('image');
        $slug       = Str::slug($request->title).'-'.time();
        $post       = Post::find($id);
        if ( isset($image) ) {
            $current_date = Carbon::now()->toDateString();        
            $imageName  = $current_date. '.'. uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('post') ) {
                Storage::disk("public")->makeDirectory('post');                
            }
            $request->image->storeAs('/public/post/', $imageName);
            Storage::disk('public')->delete('post/'.$post->image);
        } else {
            $imageName  = $post->image;
        }        
        $post->user_id  = Auth::id();
        $post->title    = $request->title;
        $post->slug     = $slug;
        $post->image    = $imageName;
        $post->body     = $request->body;
        if (isset($request->status)) {
            $post->status = true;
        }else {
            $request->status = false;
        }        

        $post->is_approved = true;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Toastr::success("Post has been  updated successfully..)", 'Success');
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        $post->delete();
        $post->categories()->detach();
        $post->tags()->detach();

        if ( Storage::disk('public')->exists('post/'.$post->image) ) {
            Storage::disk("public")->delete('post/'.$post->image);
        }
        Toastr::success("Post has been deleted successfully...", 'Success');
        return redirect()->route('admin.post.index');
    }

}