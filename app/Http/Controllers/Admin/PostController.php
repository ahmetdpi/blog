<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController
{
    // Tüm yazıları listele
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        return view('admin.Posts.post-index', compact('posts'));
    }

    public function create()
    {
        return view('admin.Posts.post-create');
    }

    public function store(Request $request)
    {
        DB::table('posts')->insert([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'country' => $request->country,
            'content' => $request->content,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Yazı oluşturuldu!');
    }

    public function edit(string $id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return view('admin.Posts.post-edit', compact('post'));
    }

    public function update(Request $request, string $id)
    {
        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'country' => $request->country,
            'content' => $request->content,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Yazı güncellendi!');
    }

    public function destroy(string $id)
    {
        DB::table('posts')->where('id', $id)->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Yazı silindi!');
    }
}
