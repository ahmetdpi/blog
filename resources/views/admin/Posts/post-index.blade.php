@extends('layouts.admin')

@section('page-title', 'Yazılar')

@section('content')

    <section style="margin-top: 60px;">

        @if(session('success'))
            <div style="display:flex; align-items:center; gap:8px; background:rgba(34,197,94,0.12); border:1px solid rgba(74,222,128,0.3); border-radius:8px; padding:10px 16px; margin-bottom:24px; font-size:13px; color:#4ade80;">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="2 8 6 12 14 4"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div style="display:flex; justify-content:flex-end; margin-bottom:20px;">
            <a href="{{ route('admin.posts.create') }}" style="background:#4f46e5; border:none; color:white; padding:10px 24px; border-radius:8px; font-size:14px; font-weight:500; cursor:pointer; display:flex; align-items:center; gap:6px; text-decoration:none;">
                <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="2" x2="8" y2="14"/><line x1="2" y1="8" x2="14" y2="8"/></svg>
                Yeni Yazı
            </a>
        </div>

        <div style="background:#151525; border:1px solid rgba(99,102,241,0.18); border-radius:14px; overflow:hidden;">

            <div style="padding:16px 22px; border-bottom:1px solid rgba(99,102,241,0.18); display:flex; align-items:center; gap:10px;">
                <div style="width:28px; height:28px; border-radius:7px; background:rgba(79,70,229,0.15); border:1px solid rgba(99,102,241,0.32); display:flex; align-items:center; justify-content:center; font-size:14px;">📝</div>
                <div>
                    <div style="font-size:13px; font-weight:500; color:#c7d2fe;">Tüm Yazılar</div>
                    <div style="font-size:11px; color:#64748b;">{{ $posts->count() }} yazı</div>
                </div>
            </div>

            @forelse($posts as $post)
                <div style="padding:16px 22px; border-bottom:1px solid rgba(99,102,241,0.1); display:flex; align-items:center; justify-content:space-between;">
                    <div>
                        <div style="font-size:13px; font-weight:500; color:#f1f0ff;">{{ $post->title }}</div>
                        <div style="font-size:11px; color:#64748b; margin-top:3px;">
                            {{ $post->country ?? '-' }} · {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                        </div>
                    </div>
                    <div style="display:flex; gap:8px;">
                        <a href="{{ route('admin.posts.edit', $post->id) }}" style="background:rgba(79,70,229,0.15); border:1px solid rgba(99,102,241,0.3); color:#c7d2fe; padding:6px 14px; border-radius:6px; font-size:12px; text-decoration:none;">Düzenle</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Silmek istediğine emin misin?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:rgba(239,68,68,0.1); border:1px solid rgba(248,113,113,0.3); color:#f87171; padding:6px 14px; border-radius:6px; font-size:12px; cursor:pointer;">Sil</button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="padding:40px; text-align:center; color:#64748b; font-size:13px;">
                    Henüz yazı yok. <a href="{{ route('admin.posts.create') }}" style="color:#818cf8;">İlk yazıyı oluştur →</a>
                </div>
            @endforelse

        </div>

    </section>

@endsection
