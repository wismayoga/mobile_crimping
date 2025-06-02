@extends('layouts.app')

@section('title', 'Daftar Soal Quiz')

@section('content')
    <div class="container">
        <h1 class="mb-4">Soal Quiz: {{ $quiz->title }}</h1>

        <a href="{{ route('questions.create', $quiz) }}" class="btn btn-primary mb-3">Tambah Soal Baru</a>
        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Quiz</a>

        @if ($questions->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th>Jawaban Benar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{ $question->question }}</td>
                            <td>{{ strtoupper($question->correct_answer) }}</td>
                            <td>
                                <a href="{{ route('questions.edit', [$quiz, $question]) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('questions.destroy', [$quiz, $question]) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $questions->links() }}
        @else
            <p>Belum ada soal untuk quiz ini.</p>
        @endif
    </div>
@endsection
