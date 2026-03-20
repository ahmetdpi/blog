<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        $settings = DB::table('site_settings')->pluck('value', 'key')->toArray();

        return view('home', compact('posts', 'settings'));
    }
}
