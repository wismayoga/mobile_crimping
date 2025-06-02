@extends('layouts.app')

@section('title', 'Edit Quiz')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Quiz: {{ $quiz->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('quizzes.update', $quiz) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Quiz</label>
                <input type="text" name="title" id="title" class="form-control" required
                    value="{{ old('title', $quiz->title) }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Quiz</button>
            <a href="{{ route('quizzes.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
@endsection
