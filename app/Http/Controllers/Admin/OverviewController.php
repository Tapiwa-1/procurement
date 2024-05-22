<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OverviewController extends Controller
{
    //
    public function index(){
      
        $users = User::with('roles')->take(5)->get();
        $superAdminCount = User::with('roles')->get()->count();
        return Inertia::render("Admin/Overview/Index",compact("users","superAdminCount"));
    }
}
