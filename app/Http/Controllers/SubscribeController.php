<?php
namespace App\Http\Controllers;
use App\Models\Subscribe;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscribes'
        ]);
        $subscribe = new Subscribe();
        $subscribe->email = $request->email;
        $subscribe->save();
        Toastr::success('You Successfully added to our subscriber list :)','Success');
        return redirect()->back();
    }
}
