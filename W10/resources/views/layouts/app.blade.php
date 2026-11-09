@php
    $dark = request()->query('mode') === 'dark';
    $keep = request()->only('mode'); // keeps dark mode while navigating
    $currentUser = auth()->user();
    $canAccessAdmin = $currentUser?->hasAnyRole(['Admin', 'Staf']) ?? false;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Profil Akademik') }} | Mini Website</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans min-h-screen flex flex-col {{ $dark ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900' }}">

    {{-- Navbar --}}
    <nav class="{{ $dark ? 'bg-blue-950 text-blue-50' : 'bg-blue-800 text-white' }}">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-wrap items-center gap-x-5 gap-y-2">
            <a href="{{ route('home', $keep) }}" class="font-bold">Akademik</a>
            <a href="{{ route('home', $keep) }}" class="hover:underline">Beranda</a>
            <a href="{{ route('profil', $keep) }}" class="hover:underline">Profil</a>
            <a href="{{ route('ide', $keep) }}" class="hover:underline">Ide-Riset</a>

            @auth
                @if ($canAccessAdmin)
                    <a href="{{ url('/admin') }}" class="rounded-full bg-amber-400 px-3 py-1 text-sm font-semibold text-gray-900 hover:bg-amber-300">
                        Dashboard Admin
                    </a>
                @endif

                <a href="{{ route('profile.edit') }}" class="hover:underline">{{ $currentUser->name }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth

            {{-- Theme toggle --}}
            <a href="{{ $dark ? request()->fullUrlWithoutQuery('mode') : request()->fullUrlWithQuery(['mode' => 'dark']) }}"
               class="ml-auto px-3 py-1 rounded-full text-sm font-medium
                      {{ $dark ? 'bg-yellow-400 text-gray-900 hover:bg-yellow-300' : 'bg-gray-900 text-white hover:bg-gray-700' }}">
                {{ $dark ? '☀️ Light Mode' : '🌙 Dark Mode' }}
            </a>
        </div>
    </nav>

    @isset($header)
        <header class="{{ $dark ? 'bg-gray-800 text-gray-100' : 'bg-white text-gray-900' }} shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Content --}}
    <main class="flex-1 w-full">
        @if (isset($slot) && trim((string) $slot) !== '')
            {{ $slot }}
        @else
            <div class="max-w-4xl w-full mx-auto px-4 py-8">
                @yield('content')
            </div>
        @endif
    </main>

    {{-- Footer --}}
    <footer class="{{ $dark ? 'bg-gray-950 text-gray-400' : 'bg-blue-900 text-blue-100' }} text-center py-4 text-sm">
        &copy; {{ date('Y') }} Institut Teknologi Sepuluh Nopember (ITS), Surabaya
    </footer>
</body>
</html>
