<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = User::where('role', 'siswa')->paginate(10);
        return view('siswa.index', compact('siswa'));
    }

    public function show(User $siswa)
    {
        abort_if($siswa->role !== 'siswa', 404);
        return view('siswa.show', compact('siswa'));
    }

    public function edit(User $siswa)
    {
        abort_if($siswa->role !== 'siswa', 404);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, User $siswa)
    {
        abort_if($siswa->role !== 'siswa', 404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $siswa->id,
        ]);

        $siswa->update($request->only('name', 'email'));

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }
}
