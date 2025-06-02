@extends('layouts.app')

@section('title', 'Kelola Quiz')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Quiz</h1>
    </div>

    @if (session('success'))
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endpush
    @endif

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('quizzes.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Buat Kuis Baru</span>
        </a>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Quiz</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Kuis</th>
                            <th>Jumlah Soal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                            <tr>
                                <td>{{ $quiz->title }}</td>
                                <td>{{ $quiz->questions->count() }}</td>
                                <td>
                                    <a href="{{ route('questions.index', $quiz) }}" class="btn btn-success btn-sm">Lihat</a>
                                    <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada kuis</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $quizzes->links() }}
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
