@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Profil Mahasiswa</h1>
    <div class="grid sm:grid-cols-2 gap-4">
        @foreach ($profil as $label => $value)
            <x-info-card :label="$label" :value="$value" />
        @endforeach
    </div>
@endsection
