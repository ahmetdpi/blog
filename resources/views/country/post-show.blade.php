@extends('layouts.app')

@section('content')

    <div class="max-w-5xl mx-auto mt-24 px-4">

        {{-- Başlık --}}
        <div class="mb-12">
            <a href="/" class="text-sm text-gray-500 hover:text-white transition mb-4 inline-block">← Ana Sayfa</a>
            <h1 class="text-4xl font-bold text-white capitalize">{{ $country }}</h1>
            <p class="text-gray-400 mt-2 text-sm">{{ $posts->count() }} yazı</p>
        </div>

        {{-- Yazı Listesi --}}
        @forelse($posts as $post)
            <a href="{{ route('post.show', $post->slug) }}" class="block mb-6 group">
                <div class="bg-white/5 border border-white/10 rounded-xl p-6 hover:bg-white/10 hover:border-indigo-500/40 transition-all duration-300">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-white group-hover:text-indigo-300 transition">{{ $post->title }}</h2>
                            <p class="text-gray-400 text-sm mt-2 leading-relaxed">{{ Str::limit($post->content, 150) }}</p>
                        </div>
                        <span class="text-indigo-400 text-xl shrink-0 group-hover:translate-x-1 transition-transform">→</span>
                    </div>
                    <div class="mt-4 text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-20 text-gray-500">
                Henüz bu ülkeye ait yazı yok.
            </div>
        @endforelse

    </div>

@endsection
