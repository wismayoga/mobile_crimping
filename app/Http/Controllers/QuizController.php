<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $guru = Auth::user();
        $quizzes = Quiz::where('user_id', $guru->id)->latest()->paginate(10);
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Quiz::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Kuis berhasil dibuat.');
    }

    // edit, update, show, destroy mirip PostController
}
