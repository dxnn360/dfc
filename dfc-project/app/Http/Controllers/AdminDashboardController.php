<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DocumentTemplate;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {

        $templates = DocumentTemplate::all()->keyBy('type');

        $totalUsers = User::count();

        $query = User::with('roles');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10);

        return view('admin.dashboard', compact('users', 'templates', 'totalUsers'));
    }
}
