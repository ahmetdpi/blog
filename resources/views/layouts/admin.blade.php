<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/css/admin.css'])
</head>
<body>

<div class="adm-wrap">

    <aside class="adm-sidebar">
        <div class="adm-logo-area">
            <div class="adm-logo-text">agentix</div>
            <div class="adm-logo-sub">Admin Paneli</div>
        </div>
        <div class="adm-nav-section">
            <span class="adm-nav-label">Genel</span>
            <a href="{{ url('admin/dashboard') }}" class="adm-nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ url('admin/posts') }}" class="adm-nav-item {{ request()->is('admin/posts*') ? 'active' : '' }}">Yazılar</a>
            <a href="{{ url('admin/settings') }}" class="adm-nav-item {{ request()->is('admin/settings*') ? 'active' : '' }}">Site Ayarları</a>
        </div>
    </aside>

    <div class="adm-main">
        <div class="adm-topbar">
            <span class="adm-topbar-title">@yield('page-title', 'Admin Panel')</span>
        </div>
        <main class="adm-content">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
