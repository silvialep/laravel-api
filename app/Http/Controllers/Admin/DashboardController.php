<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home() {

        $user = Auth::user();

        return view('admin.dashboard', compact('user'));
    }

    public function search(Request $request)
    {
        if ($request->has('title')) {

            $projects = Project::where('title', 'like', "%$request->title%")->get();
        } else {
            $projects = Project::all();
        }

        return view('admin.projects.search', compact(['projects']));
    }

 
}
