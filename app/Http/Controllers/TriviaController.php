<?php

namespace App\Http\Controllers;

use App\Models\Trivia;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\AssignOp\Div;

class TriviaController extends Controller
{

    public function index()
    {
        $trivia = Trivia::where('user_id', auth()->user()->id)
            ->orderBy('answer', 'ASC')
            ->orderBy('id', 'ASC')
            ->first();
        $answers = [$trivia->correct_answer, rand(1, 100), rand(1, 100)];
        shuffle($answers);

        return view('trivia.index', ['trivia' => $trivia, 'answers' => $answers]);
    }

    public function store()
    {
        Trivia::truncate();

        for ($i = 0; $i < 20; $i++)
        {
            $num = rand(1, 100);
            $triviaData = Http::get("http://numbersapi.com/$num?json");

            $question = $triviaData->json(['text']);
            $correct_answer = $triviaData->json(['number']);

            $question = str_replace($correct_answer,"What ", $question);

            $trivia = (new Trivia([
                'question' => $question,
                'correct_answer' => $correct_answer
            ]));
            $trivia->user()->associate(auth()->user());
            $trivia->save();
        }

        return redirect()->route('trivia.index');
    }

    public function check(Request $request)
    {
        $trivia = Trivia::where('user_id', auth()->user()->id)
            ->orderBy('answer', 'ASC')
            ->orderBy('id', 'ASC')
            ->first();

        $correctAnswers = Trivia::whereNotNull('answer')->count();

        if ($correctAnswers === 20)
        {
            return view('trivia/victory');
        }

        if ($trivia->correct_answer == $request->get('answer'))
        {
            $trivia->update(['answer' => $request->get('answer')]);
            $trivia->save();
            return redirect()->route('trivia.index');
        } else
        {
            $trivia->update(['answer' => $request->get('answer')]);
            $trivia->save();
            return view('trivia/defeat', ['trivia' => $trivia, 'correctAnswers' => $correctAnswers]);
        }
    }
}
