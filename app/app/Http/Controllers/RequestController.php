<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function create()
    {
        return view('requests.create');
    }
}
