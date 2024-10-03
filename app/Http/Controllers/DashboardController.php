<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $posts = Auth::user()->posts()->latest()->paginate(6);
        // dd($posts);
        return view('users.dashboard', ["posts" => $posts]);
    }
}