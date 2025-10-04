<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DocumentTemplate;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $templates = DocumentTemplate::all()->keyBy('type');

        return view('admin.dashboard', compact('users', 'templates'));
    }
}
