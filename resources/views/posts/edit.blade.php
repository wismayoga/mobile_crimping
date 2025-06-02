@extends('layouts.app')

@section('title', 'Edit Materi')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <h1 class="h3 mb-4 text-gray-800">Edit Materi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Materi</label>
                <input type="text" name="title" class="form-control" required value="{{ old('title', $post->title) }}">
            </div>

            <div class="form-group">
                <label for="content">Isi Materi</label>
                <input id="isiMateri" type="hidden" name="content" value="{{ old('content', $post->content) }}">
                <trix-editor input="isiMateri"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Materi</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.umd.min.js"></script>

    <script>
        document.addEventListener("trix-attachment-add", function(event) {
            if (event.attachment.file) {
                uploadAttachment(event.attachment);
            }
        });

        function uploadAttachment(attachment) {
            let file = attachment.file;
            let form = new FormData();
            form.append("file", file);
            form.append("_token", "{{ csrf_token() }}");

            fetch("{{ route('trix.upload') }}", {
                    method: "POST",
                    body: form
                })
                .then(response => response.json())
                .then(data => {
                    if (data.url) {
                        attachment.setAttributes({
                            url: data.url,
                            href: data.url
                        });
                    }
                })
                .catch(error => {
                    console.error("Upload gagal:", error);
                });
        }
    </script>
@endpush
