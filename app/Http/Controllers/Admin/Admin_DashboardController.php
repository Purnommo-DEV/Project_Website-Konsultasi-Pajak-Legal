<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin_DashboardController extends Controller
{
    public function dashboard()
    {
        return view('Admin.dashboard.dashboard');
    }
}
