@extends('layouts.admin')

@section('page-title', 'Yeni Yazı')

@section('content')

    <section style="margin-top: 60px;">

        @if($errors->any())
            <div style="display:flex; align-items:center; gap:8px; background:rgba(239,68,68,0.12); border:1px solid rgba(248,113,113,0.3); border-radius:8px; padding:10px 16px; margin-bottom:24px; font-size:13px; color:#f87171;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf

            <div style="background:#151525; border:1px solid rgba(99,102,241,0.18); border-radius:14px; overflow:hidden; margin-bottom:20px;">

                <div style="padding:16px 22px; border-bottom:1px solid rgba(99,102,241,0.18); display:flex; align-items:center; gap:10px;">
                    <div style="width:28px; height:28px; border-radius:7px; background:rgba(79,70,229,0.15); border:1px solid rgba(99,102,241,0.32); display:flex; align-items:center; justify-content:center; font-size:14px;">✍️</div>
                    <div>
                        <div style="font-size:13px; font-weight:500; color:#c7d2fe;">Yeni Yazı</div>
                        <div style="font-size:11px; color:#64748b;">Yeni blog yazısı oluştur</div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr;">

                    {{-- Başlık --}}
                    <div style="padding:14px 22px; border-bottom:1px solid rgba(99,102,241,0.18); border-right:1px solid rgba(99,102,241,0.18); display:flex; flex-direction:column; gap:6px;">
                        <label style="font-size:11px; color:#64748b; font-weight:500; text-transform:uppercase; letter-spacing:0.06em;">Başlık</label>
                        <input type="text" name="title" value="{{ old('title') }}" style="background:#0f0f1a; border:1px solid rgba(99,102,241,0.18); border-radius:7px; padding:8px 12px; font-size:13px; color:#f1f0ff; outline:none; width:100%; box-sizing:border-box;">
                    </div>

                    {{-- Ülke --}}
                    <div style="padding:14px 22px; border-bottom:1px solid rgba(99,102,241,0.18); display:flex; flex-direction:column; gap:6px;">
                        <label style="font-size:11px; color:#64748b; font-weight:500; text-transform:uppercase; letter-spacing:0.06em;">Ülke</label>
                        <select name="country" style="background:#0f0f1a; border:1px solid rgba(99,102,241,0.18); border-radius:7px; padding:8px 12px; font-size:13px; color:#f1f0ff; outline:none; width:100%; box-sizing:border-box;">
                            <option value="">Seç...</option>
                            <option value="vietnam" {{ old('country') == 'vietnam' ? 'selected' : '' }}>VİETNAM</option>
                            <option value="thailand" {{ old('country') == 'thailand' ? 'selected' : '' }}>THAİLAND</option>
                            <option value="cambodia" {{ old('country') == 'cambodia' ? 'selected' : '' }}>CAMBODİA</option>
                            <option value="maleysia" {{ old('country') == 'maleysia' ? 'selected' : '' }}>MALEYSİA</option>
                        </select>
                    </div>

                    {{-- İçerik --}}
                    <div style="padding:14px 22px; grid-column:1/-1; display:flex; flex-direction:column; gap:6px;">
                        <label style="font-size:11px; color:#64748b; font-weight:500; text-transform:uppercase; letter-spacing:0.06em;">İçerik</label>
                        <textarea name="content" rows="10" style="background:#0f0f1a; border:1px solid rgba(99,102,241,0.18); border-radius:7px; padding:8px 12px; font-size:13px; color:#f1f0ff; outline:none; width:100%; box-sizing:border-box; resize:vertical; font-family:inherit; line-height:1.6;">{{ old('content') }}</textarea>
                    </div>

                </div>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('admin.posts.index') }}" style="background:transparent; border:1px solid rgba(99,102,241,0.3); color:#c7d2fe; padding:10px 24px; border-radius:8px; font-size:14px; font-weight:500; cursor:pointer; text-decoration:none;">
                    İptal
                </a>
                <button type="submit" style="background:#4f46e5; border:none; color:white; padding:10px 24px; border-radius:8px; font-size:14px; font-weight:500; cursor:pointer; display:flex; align-items:center; gap:6px;">
                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="2 8 6 12 14 4"/></svg>
                    Kaydet
                </button>
            </div>

        </form>
    </section>

@endsection
