<?php

namespace App\Http\Controllers\Admin\Auth;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
       
    use ThrottlesLogins;

    public function __construct() 
    {
        $this->middleware('guest:admin')->except('logout');
    }
    
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);
    }

    /**
     * Login the admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        //Validation...
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);


        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }



        //Attempt Login and redirect the admin...
        if(auth('admin')->attempt($credentials, $request->filled('remember')))
        {
            //login successfully
            return redirect()->intended(route('admin.home'));
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);
        
        //Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);

        
      
    }

    /**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        //logout the admin...
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('status','Admin has been logged out!');
    }

    public function username(){
        return 'email';
    }
    
}
