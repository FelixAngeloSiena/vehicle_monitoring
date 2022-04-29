<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function admin_dashboard(){
        return view('content.admin.admin_dashboard');
    }

    public function user_accounts(){
        $users = User::select('name', 'email','role')
        ->get();
        return view('content.admin.user_accounts',compact('users'));
    }

    public function create_users(Request $request){
        User::create([
            'name'=>$request->create_user_name,
            'email'=>$request->create_user_email,
            'password' => bcrypt($request->create_user_password),
            'role'=>$request->create_user_role,
        ]);
        
    }
}
