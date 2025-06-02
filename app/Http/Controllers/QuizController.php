<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('user_id', Auth::id())->latest()->paginate(10);
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Quiz::create([
            'user_id' => Auth::id(),
            'title' => $request->title
        ]);
        return redirect()->route('quizzes.index')->with('success', 'Kuis berhasil dibuat.');
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate(['title' => 'required']);
        $quiz->update(['title' => $request->title]);
        return redirect()->route('quizzes.index')->with('success', 'Kuis berhasil diperbarui.');
    }

    public function show(Quiz $quiz)
    {
        // Load questions relationship jika belum eager loaded
        $quiz->load('questions');

        return view('quizzes.show', compact('quiz'));
    }
}
