@extends('layouts.app')

@section('title', 'Buat Quiz Baru')

@section('content')
    <div class="container">
        <h1 class="mb-4">Buat Quiz Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('quizzes.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Judul Quiz</label>
                <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Quiz</button>
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
@endsection
