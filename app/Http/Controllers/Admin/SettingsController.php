<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class SettingsController extends Controller
{
    public function index(){
        return view('admin.settings');
    }

    public function updateProfile(Request $request){
        $this->validate($request,  [
            'name'      => 'required',
            'email'     => 'required',
            'image'     => 'image',
            'about'     => 'required',
        ]);

        $image      = $request->file('image');
        $user       = User::findOrfail(Auth::id());
        if ( isset($image) ) {
            $current_date = Carbon::now()->toDateString();        
            $imageName  = $current_date. '.'. uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile') ) {
                Storage::disk("public")->makeDirectory('profile');                
            }
            $request->image->storeAs('/public/profile/', $imageName);
            Storage::disk('public')->delete('profile/'.$user->image);
        } else {
            $imageName  = $user->image;
        }

        $user->name    = $request->name;
        $user->email    = $request->email;
        $user->image    = $imageName;
        $user->about     = $request->about;
        $user->save();
        Toastr::success("Profile has been  updated successfully..)", 'Success');
        return redirect()->back();
    }

    public function updatePassword(Request $request){        
        $this->validate($request, [
            'old_password'          => 'required',
            'password'      => 'required|confirmed',
        ]);
    $hashedPassword = Auth::user()->password;
    if (Hash::check($request->old_password, $hashedPassword)) {
        
        if( !Hash::check($request->password, $hashedPassword )  ){
            $user = User::findOrfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Toastr::success('Password Successfully Changed','Success');
            Auth::logout();
            return redirect()->back();
        }else {
            Toastr::error('New password cannot be the same as old password.','Error');
            return redirect()->back();
        }        
    }
    else{
       Toastr::error('Current password not match.','Error');
       return redirect()->back();
   }

    }
    

}