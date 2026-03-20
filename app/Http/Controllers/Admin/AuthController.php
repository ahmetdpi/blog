<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = DB::table('admins')
            ->where('username', $request->username)
            ->first();

        if ($admin && password_verify($request->password, $admin->password)) {
            session(['admin_id' => $admin->id]);
            return redirect()->route('admin.posts.index');
        }

        return back()->with('error', 'Kullanıcı adı veya şifre yanlış');
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('admin.login');
    }
}
