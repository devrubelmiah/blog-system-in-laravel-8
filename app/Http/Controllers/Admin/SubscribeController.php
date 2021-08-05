<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Subscribe;
use Brian2694\Toastr\Facades\Toastr;


class SubscribeController extends Controller
{
    public function index()
    {
        $subscribes = Subscribe::latest()->get();
        return view('admin.subscribe', compact('subscribes'));
    }

    public function destroy($subscribe)
    {
        Subscribe::findOrfail($subscribe)->delete();
        Toastr::success('Subscriber Successfully Deleted :)','Success');
        return redirect()->back();
    }
    
}
