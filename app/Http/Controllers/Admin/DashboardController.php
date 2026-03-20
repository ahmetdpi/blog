<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
        $posts    = DB::table('posts')->orderBy('created_at', 'desc')->get();
        $settings = DB::table('site_settings')->pluck('value', 'key')->toArray();

        return view('admin.dashboard', compact('posts', 'settings'));
    }
}
