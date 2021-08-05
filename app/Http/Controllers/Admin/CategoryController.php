<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,jpg,png,gift,bmp'
        ]);

        $image      = $request->file('image');
        $slug       = Str::slug($request->name);
        
        if ( isset($image) ) {
            $current_date = Carbon::now()->toDateString();
            $imageName  = $slug.'-'. $current_date. '.'. uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('category') ) {
                Storage::disk("public")->makeDirectory('category');
            }
            $request->image->storeAs('/public/category/', $imageName);
        } else {
            $imageName = 'default.png';
        }
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category added successfully :)','Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrfail($id);
        return view('admin.category.edit', compact('category'));
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
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'mimes:jpeg,jpg,png,gift,bmp'
        ]);

        $category   = Category::findOrfail($id);
        $image      = $request->file('image');
        $slug       = Str::slug($request->name);                
        if ( isset($image) ) {
            $current_date = Carbon::now()->toDateString();
            $imageName  = $slug.'-'. $current_date. '.'. uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('category') ) {
                Storage::disk("public")->makeDirectory('category');
            }
            $request->image->storeAs('/public/category/', $imageName);
            Storage::disk('public')->delete('category/'.$category->image);
        } else {
            $imageName = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;
        $category->save();
        Toastr::success('Category updated successfully :)','Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrfail($id);
        Storage::disk('public')->delete('category/'.$category->image);
        $category->delete();
        Toastr::success('Category deleted successfully :)','Success');
        return redirect()->route('admin.category.index');

    }
}
