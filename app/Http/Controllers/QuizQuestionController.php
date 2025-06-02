<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->paginate(10);
        return view('quiz_questions.index', compact('quiz', 'questions'));
    }

    public function create(Quiz $quiz)
    {
        return view('quiz_questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        $quiz->questions()->create($request->all());
        return redirect()->route('questions.index', $quiz)->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz, Question $question)
    {
        return view('quiz_questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_answer' => 'required|in:a,b,c,d',
        ]);

        $question->update($request->all());
        return redirect()->route('questions.index', $quiz)->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index', $quiz)->with('success', 'Soal berhasil dihapus.');
    }
}
