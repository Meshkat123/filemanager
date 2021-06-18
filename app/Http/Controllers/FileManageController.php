<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileManageController extends Controller
{
    public function Index(){
    	$title 		= "Files";

    	return View('files.index',compact('title'));
    }
}
