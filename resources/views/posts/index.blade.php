@extends('layouts.app')

@section('title', 'Kelola Materi')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Materi</h1>
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
        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Materi</span>
        </a>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Materi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Judul Materi</th>
                            <th>Dibuat Pada</th>
                            <th>Diubah Pada</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td class="text-center">{{ $post->created_at }}</td>
                                <td class="text-center">{{ $post->updated_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-success btn-circle mr-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-circle mr-1">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-circle" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $posts->links() }}
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
