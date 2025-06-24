<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withCount('violationReports')
            ->orderByDesc('violation_reports_count')
            ->paginate(10); // ページネーションも忘れずに

        $posts = \App\Models\Post::latest()->paginate(10);

        return view('auth.admin.dashboard', compact('users', 'posts'));
    }
}
