<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Web Edukasi</title>
</head>

<body>
    @auth
        <p>Halo, {{ auth()->user()->name }} ({{ auth()->user()->role }}) |
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
        </p>
    @endauth

    @yield('content')
</body>

</html>
