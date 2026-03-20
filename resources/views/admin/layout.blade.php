<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white p-5">
        <h2 class="text-2xl font-bold mb-8">Admin Panel</h2>
        <ul class="space-y-3">
            <li><a href="{{ url('admin/dashboard') }}" class="block hover:text-gray-300">Dashboard</a></li>
            <li><a href="{{ url('admin/posts') }}" class="block hover:text-gray-300">Yazılar</a></li>
            <li><a href="{{ url('admin/categories') }}" class="block hover:text-gray-300">Kategoriler</a></li>
            <li><a href="{{ url('admin/comments') }}" class="block hover:text-gray-300">Yorumlar</a></li>
        </ul>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-10">
        @yield('content')
    </main>

</div>

</body>
</html>
