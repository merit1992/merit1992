<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct() {
        $this->middleware('guest:admin');
    }

   
    /**
     * Show the reset email form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm(){
        return view('auth.passwords.email',[
            'title' => 'Admin Password Reset',
            'passwordEmailRoute' => 'admin.password.email'
        ]);
    }

    /**
     * password broker for admin guard.
     * 
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker(){
        return Password::broker('admins');
    }

    /**
     * Get the guard to be used during authentication
     * after password reset.
     * 
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    public function guard(){
        return FacadesAuth::guard('admin');
    }
}
