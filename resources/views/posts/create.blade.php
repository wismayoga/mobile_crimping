@extends('layouts.app')

@section('title', 'Tambah Materi')

@section('content')
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Tambah Materi Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Judul Materi</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="content">Isi Materi</label>
                <textarea name="content" id="editor" class="form-control" rows="10" required>{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Materi</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

@section('scripts')
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
