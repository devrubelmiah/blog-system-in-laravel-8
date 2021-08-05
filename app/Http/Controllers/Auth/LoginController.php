<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    //= RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        if (Auth::check() && Auth::user()->role->id == 1)
        {
            //$this->redirectTo = route('admin.dashboard');
             return redirect()->route('admin.dashboard');
        } elseif (Auth::check() && Auth::user()->role->id == 2) {
           // $this->redirectTo = route('author.dashboard');
            return redirect()->route('author.dashboard');
        } else{
            $this->middleware('guest')->except('logout');
        }
    }

    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (Auth::check() && Auth::user()->role->id == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::check() && Auth::user()->role->id == 2) {
                return redirect()->route('author.dashboard');
            }
            else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }

}
