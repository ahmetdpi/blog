<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PostController
{
    public function country($country)
    {
        $posts = DB::table('posts')->where('country', $country)->latest()->get();
        return view('country.post-show', compact('posts', 'country'));
    }

    public function show($slug)
    {
        $post = DB::table('posts')->where('slug', $slug)->first();
        abort_if(!$post, 404);
        return view('country.post', compact('post'));
    }
}
