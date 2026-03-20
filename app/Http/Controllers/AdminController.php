<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $req)
    {
        $admin = DB::table('admins')
            ->where('username', $req->username)
            ->first();

        if ($admin && password_verify($req->password, $admin->password)) {
            session(['admin_id' => $admin->id]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Kullanıcı adı veya şifre hatalı');
    }

    public function dashboard()
    {
        if (!session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }
        $posts =   DB::table('posts')->get();
        $settings = DB::table('site_settings')->pluck('value', 'key')->toArray();

        return view('admin.dashboard', compact('posts', 'settings'));
    }


}
