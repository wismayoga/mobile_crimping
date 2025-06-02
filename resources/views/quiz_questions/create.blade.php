@extends('layouts.app')

@section('title', 'Tambah Soal')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Soal untuk Quiz: {{ $quiz->title }}</h1>

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
                <textarea name="question" id="question" class="form-control" required>{{ old('question') }}</textarea>
            </div>

            <div class="form-group">
                <label for="option_a">Pilihan A</label>
                <input type="text" name="option_a" id="option_a" class="form-control" required
                    value="{{ old('option_a') }}">
            </div>

            <div class="form-group">
                <label for="option_b">Pilihan B</label>
                <input type="text" name="option_b" id="option_b" class="form-control" required
                    value="{{ old('option_b') }}">
            </div>

            <div class="form-group">
                <label for="option_c">Pilihan C</label>
                <input type="text" name="option_c" id="option_c" class="form-control" required
                    value="{{ old('option_c') }}">
            </div>

            <div class="form-group">
                <label for="option_d">Pilihan D</label>
                <input type="text" name="option_d" id="option_d" class="form-control" required
                    value="{{ old('option_d') }}">
            </div>

            <div class="form-group">
                <label for="correct_answer">Jawaban Benar</label>
                <select name="correct_answer" id="correct_answer" class="form-control" required>
                    <option value="">-- Pilih Jawaban Benar --</option>
                    <option value="a" {{ old('correct_answer') == 'a' ? 'selected' : '' }}>A</option>
                    <option value="b" {{ old('correct_answer') == 'b' ? 'selected' : '' }}>B</option>
                    <option value="c" {{ old('correct_answer') == 'c' ? 'selected' : '' }}>C</option>
                    <option value="d" {{ old('correct_answer') == 'd' ? 'selected' : '' }}>D</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan Soal</button>
            <a href="{{ route('questions.index', $quiz) }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
@endsection
