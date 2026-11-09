@extends('layouts.app')

@section('content')
    @if ($user)
        <x-status-banner type="info">
            Selamat datang, <strong>{{ $user }}</strong>! 👋
        </x-status-banner>
    @endif

    <h1 class="text-3xl font-bold mb-2">Beranda</h1>
    <p class="mb-6">Mini-website akademik pribadi: profil diri, rancangan platform Agentic AI, dan formulir ide.</p>

    {{-- Challenge 2: trigger with an input plus button --}}
    <form method="GET" action="{{ url('/beranda') }}" class="flex gap-2 mb-4">
        @if (request('mode'))
            <input type="hidden" name="mode" value="{{ request('mode') }}">
        @endif
        <input type="text" name="user" value="{{ $user }}" placeholder="Masukkan nama kamu..."
               class="flex-1 border rounded p-2 text-gray-900" required>
        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">
            Sapa Saya
        </button>
    </form>

    {{-- Challenge 2: trigger with clickable cards --}}
    <div class="grid sm:grid-cols-3 gap-3">
        @foreach (['Andi', 'Budi', 'Citra'] as $nama)
            <a href="{{ url('/beranda') }}?{{ http_build_query(array_merge(request()->only('mode'), ['user' => $nama])) }}"
               class="block text-center bg-white text-gray-900 rounded-lg shadow p-4 border hover:border-blue-600 hover:shadow-md transition cursor-pointer">
                Sapa sebagai <strong>{{ $nama }}</strong>
            </a>
        @endforeach
    </div>

    @if ($user)
        <a href="{{ url('/beranda') }}?{{ http_build_query(request()->only('mode')) }}"
           class="inline-block mt-4 text-sm underline">Hapus sapaan</a>
    @endif
@endsection
