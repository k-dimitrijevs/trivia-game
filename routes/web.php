<?php

use App\Http\Controllers\TriviaController;
use App\Models\Trivia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Route::resource('trivia', TriviaController::class)->middleware(['auth']);


Route::get('trivia/index', [TriviaController::class, 'index'])->middleware(['auth'])->name('trivia.index');
Route::post('trivia/store', [TriviaController::class, 'store'])->middleware(['auth'])->name('trivia.store');

Route::post('trivia/check', [TriviaController::class, 'check'])->middleware(['auth']);

Route::get('trivia/defeat', function (){
   return view('trivia.defeat', [
       'trivia' => Trivia::where('user_id', auth()->user()->id)
           ->where('answer', '!=', 'correct_answer')
           ->orderBy('id', 'DESC')
           ->first(),
       'correctAnswers' => Trivia::whereNotNull('answer')->count()
   ]);
})->middleware(['auth'])->name('trivia.defeat');

Route::get('trivia/victory', function (){
    return view('trivia.victory');
})->middleware(['auth'])->name('trivia.victory');

require __DIR__.'/auth.php';
