@extends('layouts.app')

@section('title', 'Tambah Soal')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Tambah Soal ke Kuis: {{ $quiz->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('questions.store', $quiz) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="question">Pertanyaan</label>
                <textarea name="question" class="form-control" required>{{ old('question') }}</textarea>
            </div>

            <div class="form-group">
                <label for="option_a">Pilihan A</label>
                <input type="text" name="option_a" class="form-control" required value="{{ old('option_a') }}">
            </div>

            <div class="form-group">
                <label for="option_b">Pilihan B</label>
                <input type="text" name="option_b" class="form-control" required value="{{ old('option_b') }}">
            </div>

            <div class="form-group">
                <label for="option_c">Pilihan C</label>
                <input type="text" name="option_c" class="form-control" required value="{{ old('option_c') }}">
            </div>

            <div class="form-group">
                <label for="option_d">Pilihan D</label>
                <input type="text" name="option_d" class="form-control" required value="{{ old('option_d') }}">
            </div>

            <div class="form-group">
                <label for="correct_answer">Jawaban Benar</label>
                <select name="correct_answer" class="form-control" required>
                    <option value="">-- Pilih Jawaban Benar --</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Soal</button>
            <a href="{{ route('quizzes.show', $quiz) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
