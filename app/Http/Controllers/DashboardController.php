<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Index(){
        $title = "Dashboard";
       return View('dashboard',compact('title'));
    }
}
