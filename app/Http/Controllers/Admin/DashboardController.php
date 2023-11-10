<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
    
        $allProjects = Project::all()->count();
    
        return view('admin.index', compact('allProjects'));
    }
}


