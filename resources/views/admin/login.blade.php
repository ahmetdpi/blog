<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="w-full max-w-sm bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Girişi</h2>

    @if(session('error'))
        <p class="mb-4 text-red-500 text-center">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf <!-- Bu satırı mutlaka ekle -->

        <div class="mb-4">
            <label class="block mb-1 font-medium">Kullanıcı Adı</label>
            <input type="text" name="username" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-medium">Şifre</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Giriş Yap</button>
    </form>
</div>
</body>
</html>
