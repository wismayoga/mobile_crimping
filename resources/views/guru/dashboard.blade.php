@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard Guru</h1>

        <div>
            <p>Jumlah Materi: {{ $materiCount }}</p>
            <p>Jumlah Kuis: {{ $quizCount }}</p>
            <p>Jumlah Siswa: {{ $siswaCount }}</p>
        </div>

        <div>
            <a href="{{ route('posts.index') }}">Kelola Materi</a> |
            <a href="{{ route('quizzes.index') }}">Kelola Kuis</a> |
            <a href="{{ route('siswa.index') }}">Kelola Data Siswa</a>
        </div>
    </div>
@endsection
