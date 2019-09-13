<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


class AdminLoginController extends Controller
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
    protected $redirectTo = '/admin/welcome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
      return Auth::guard('admin');
    }

    public function username(){
        return 'pseudo';
    }

    public function showLoginForm(){
        if(auth('admin')->check()){
            return redirect()->route('admin.index');
        }
        return view('auth.login');
    }

    public function login(Request $request){
        if(auth()->guard('admin')->attempt(['pseudo' => $request->pseudo,'password'=>$request->password]))
        {
          return redirect($this->redirectTo());
        }

        return back()->withErrors(['pseudo'=>'Pseudo ou mot de passe invalide.']);

    }
    protected function redirectTo(){
      return route('admin.index');
    }
}

