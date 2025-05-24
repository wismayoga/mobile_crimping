@extends('layouts.app')

@section('title', 'Detail Materi')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">{{ $post->title }}</h1>

        <div class="mb-3 text-muted">
            Dibuat oleh: {{ $post->user->name }} <br>
            Tanggal: {{ $post->created_at->format('d M Y H:i') }}
        </div>

        <div class="card shadow p-4">
            {!! $post->content !!}
        </div>

        <div class="mt-3">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali ke Daftar Materi</a>
        </div>
    </div>
@endsection
