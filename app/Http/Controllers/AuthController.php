<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function auth_dashboard()
    {
        return view('content.auth.authentication');
    }

    public function attempt_login(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email",
            "password" => "required"
        ]);

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $checkRoles = Auth::user()->role;
                if( $checkRoles == 'driver'){
                    return redirect()->route('driver.dashboard'); 
                }
                if($checkRoles == 'logistic' || $checkRoles == 'admin' || $checkRoles == 'manager'){
                    return redirect()->route('admin_dashboard');
                }
                if($checkRoles == 'requestor'){
                    return redirect()->route('requestor.dashboard');
                }
                if($checkRoles == 'audit'){
                    return redirect()->route('audit.dashboard');
                }
                if($checkRoles == 'purchasing'){
                    return redirect()->route('purchasing.dashboard');
                }
                if($checkRoles == 'approver'){
                    return redirect()->route('approver.dashboard');
                }
                
            }
            Session::flash("error", "Invalid Credentials");
            return redirect()->back();
             } catch (\Throwable $th) {
            Session::flash("error", $th->getMessage());
            return redirect()->back();
        }
    }

        public function logout(Request $request) {
            try {
                Auth::logout();
                $request->session()->flush();
                $request->session()->regenerate();
    
                return redirect()->route('auth_dashboard');
    
            } catch (\Throwable $th) {
                return redirect()->route('auth_dashboard');
            }
        }

}
