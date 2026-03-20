<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AhMeTd</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
</head>
<body>

<nav class="sticky top-0 z-50 flex items-center justify-between w-full h-18 px-6 md:px-16 lg:px-24 xl:px-32 backdrop-blur">
    <a href="/">
        <img class="h-9 w-auto" alt="logo" src="{{ asset('assets/Ahmet.svg') }}" />
    </a>
    <div class="hidden lg:flex items-center gap-8 transition duration-500">
        <a href="/#creations" class="hover:text-slate-300 transition">Creations</a>
        <a href="/#about" class="hover:text-slate-300 transition">About</a>
    </div>
</nav>

@yield('content')

</body>
</html>
