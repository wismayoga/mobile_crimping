<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama" required value="{{ old('name') }}">
    <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <select name="role" required>
        <option value="">Pilih Role</option>
        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
    </select>
    <button type="submit">Register</button>
</form>
