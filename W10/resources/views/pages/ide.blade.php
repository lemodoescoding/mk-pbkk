@php $dark = request()->query('mode') === 'dark'; @endphp
@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-4">Ide Riset Agentic AI</h1>

    @if (session('status'))
        <x-status-banner type="success">{{ session('status') }}</x-status-banner>
    @endif

    @if ($errors->any())
        <x-status-banner type="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </x-status-banner>
    @endif

    <form method="POST" action="{{ route('ide.kirim', request()->only('mode')) }}"
      class="space-y-4 p-6 rounded-xl border-2 shadow-lg
             {{ $dark ? 'bg-gray-800 border-blue-400 shadow-blue-500/30' : 'bg-white border-gray-300 shadow-gray-300' }}">
        @csrf

        <div>
            <label for="nama" class="block text-sm font-medium mb-1">Nama</label>
            <input id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama"
                   class="w-full rounded-lg p-2 border-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                          {{ $dark ? 'bg-gray-900 text-gray-100 border-gray-500 placeholder-gray-400' : 'bg-white text-gray-900 border-gray-300' }}">
        </div>

        <div>
            <label for="ide" class="block text-sm font-medium mb-1">Ide Riset</label>
            <textarea id="ide" name="ide" rows="4" placeholder="Tulis ide riset Agentic AI kamu..."
                      class="w-full rounded-lg p-2 border-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500
                             {{ $dark ? 'bg-gray-900 text-gray-100 border-gray-500 placeholder-gray-400' : 'bg-white text-gray-900 border-gray-300' }}">{{ old('ide') }}</textarea>
        </div>

        <button class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg shadow">Kirim Ide</button>
    </form>
@endsection
