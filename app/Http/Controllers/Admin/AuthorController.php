<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AuthorController extends Controller
{
    public function index(){
         $authors = User::Authors()
         ->withCount('posts')
         ->get();
        return view('admin.authors', compact('authors'));
    }

    public function destroy($id)
    {
        $author = User::findOrfail($id);
        $author->delete();
        Toastr::success('Author Successfully Deleted', 'Success');
        return redirect()->back();   

    }

}
