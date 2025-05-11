<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 必要なデータがあればここで取得
        return view('auth.admin.dashboard'); // admin.dashboardビューにデータを渡して表示
    }
}
