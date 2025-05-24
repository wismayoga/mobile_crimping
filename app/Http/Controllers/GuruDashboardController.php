<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\QuickDefinitionsConfiguration;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::user();

        // Hitung jumlah materi yang dibuat
        $materiCount = Post::where('user_id', $guru->id)->count();

        // Hitung jumlah kuis yang dibuat
        $quizCount = Quiz::where('user_id', $guru->id)->count();

        // Hitung jumlah siswa (asumsikan role siswa)
        $siswaCount = User::where('role', 'siswa')->count();

        return view('guru.dashboard', compact('materiCount', 'quizCount', 'siswaCount'));
    }
}
