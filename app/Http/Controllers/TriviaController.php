<?php

namespace App\Http\Controllers;

use App\Models\Trivia;
use Dotenv\Store\File\Paths;
use Illuminate\Filesystem\Cache;
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
        $answers = [$trivia->correct_answer, rand(1, 250), rand(1, 250)];
        shuffle($answers);

        return view('trivia.index', ['trivia' => $trivia, 'answers' => $answers]);
    }

    public function store()
    {
        Trivia::truncate();

        while (Trivia::where('user_id', auth()->user()->id)->count() < 20)
        {
            $num = rand(1, 250);
            // using $num, because min, max didn't work. Using random sometimes generated too big numbers.
            $triviaData = Http::get("http://numbersapi.com/$num?json");

            $question = $triviaData->json(['text']);
            $correct_answer = $triviaData->json(['number']);

            $question = str_replace($correct_answer,"What", $question);

            if (Trivia::where('question', '=', $question)->count() > 0) continue;

            $trivia = (new Trivia([
                'question' => $question,
                'correct_answer' => $correct_answer
            ]));
            $trivia->user()->associate(auth()->user());
            $trivia->save();
        }

//        for ($i = 0; $i < 20; $i++)
//        {
//        }

        $answers = [$trivia->correct_answer, rand(1, 250), rand(1, 250)];
        shuffle($answers);

        return redirect()->route('trivia.index');
    }

    public function check(Request $request)
    {
        $request->validate([
           'answer' => 'required'
        ]);

        $trivia = Trivia::where('user_id', auth()->user()->id)
            ->orderBy('answer', 'ASC')
            ->orderBy('id', 'ASC')
            ->first();

        $correctAnswers = Trivia::whereNotNull('answer')->count();

        if ($correctAnswers === 20)
        {
            return redirect()->route('trivia.victory');
        }

        if ($trivia->correct_answer == $request->get('answer'))
        {
            $trivia->update(['answer' => $request->get('answer')]);
            $trivia->save();
            return redirect()->back();
        } else
        {
            $trivia->update(['answer' => $request->get('answer')]);
            $trivia->save();
            return redirect()->route('trivia.defeat');
        }
    }
}
