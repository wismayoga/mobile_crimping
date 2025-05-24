@extends('layouts.app')

@section('content')
    <h2>Daftar Materi</h2>
    <a href="{{ route('posts.create') }}">Buat Materi Baru</a>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a> |
                <a href="{{ route('posts.edit', $post) }}">Edit</a> |
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>

    {{ $posts->links() }}
@endsection
