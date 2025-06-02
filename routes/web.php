<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])->name('guru.dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('siswa', SiswaController::class)->only(['index', 'show', 'edit', 'update']);
    Route::post('/trix-upload', [App\Http\Controllers\TrixUploadController::class, 'upload'])->name('trix.upload');

    // Rute utama untuk kelola kuis
    Route::resource('quizzes', QuizController::class);

    // Rute untuk kelola soal dalam setiap kuis
    Route::prefix('quizzes/{quiz}')->name('questions.')->group(function () {
        Route::get('questions', [QuizQuestionController::class, 'index'])->name('index');
        Route::get('questions/create', [QuizQuestionController::class, 'create'])->name('create');
        Route::post('questions', [QuizQuestionController::class, 'store'])->name('store');
        Route::get('questions/{question}/edit', [QuizQuestionController::class, 'edit'])->name('edit');
        Route::put('questions/{question}', [QuizQuestionController::class, 'update'])->name('update');
        // Optional delete (kalau butuh)
        Route::delete('questions/{question}', [QuizQuestionController::class, 'destroy'])->name('destroy');
    });
    // Route khusus guru lainnya
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        return 'Halo Siswa';
    });
    // Route khusus siswa lainnya
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role == 'guru') {
        return redirect('/guru/dashboard');
    } elseif ($user->role == 'siswa') {
        return redirect('/siswa/dashboard');
    }

    abort(403);
})->middleware('auth');
