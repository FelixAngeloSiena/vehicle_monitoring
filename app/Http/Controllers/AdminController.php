<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Department;
use DB;

class AdminController extends Controller
{
    public function admin_dashboard(){
        return view('content.admin.admin_dashboard');
    }

    public function user_accounts(){
        return view('content.admin.user_accounts');
    }

}
