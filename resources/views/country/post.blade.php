@extends('layouts.app')

@section('content')

    <div class="max-w-3xl mx-auto mt-24 px-4 pb-24">

        {{-- Geri butonu --}}
        <a href="javascript:history.back()" class="text-sm text-gray-500 hover:text-white transition mb-8 inline-block">← Geri</a>

        {{-- Başlık --}}
        <div class="mb-10">
            <span class="text-xs text-indigo-400 uppercase tracking-widest font-medium">{{ $post->country }}</span>
            <h1 class="text-4xl font-bold text-white mt-3 leading-tight">{{ $post->title }}</h1>
            <p class="text-gray-500 text-sm mt-3">{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</p>
        </div>

        {{-- Ayraç --}}
        <div style="height:1px; background:rgba(99,102,241,0.2); margin-bottom:40px;"></div>

        {{-- İçerik --}}
        <div class="text-gray-300 leading-relaxed text-base whitespace-pre-line">
            {{ $post->content }}
        </div>

    </div>

@endsection
