<?php

namespace App\Http\Controllers\Games;

use App\Game\Question;
use App\Game\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TriviaController extends Controller
{
    public $session;

    public function __construct()
    {
        $this->middleware('auth');
        if (!Session::count()) {
            $this->session = Session::firstOrCreate(['created_at' => Carbon::now()]);
        } else {
            $this->session = Session::first();
        }
        if (!$this->session->questions) $this->session->questions = [];
    }

    public function index()
    {
        $session = $this->session;

        return view('games.trivia.index', compact('session'));
    }

    public function showQuestion(Question $question)
    {
        return view('games.trivia.question_show', compact('question'));
    }

    public function updateQuestion(Question $question)
    {
        $this->validate(request(), [
            'option' => 'required',
        ]);
        $option = request('option');
        $this->session->questions = array_unique(array_merge($this->session->questions, [$question->id=>$option]));
        $this->session->save();
        $results = [];
        if($option == 'answer'){
            $results['status'] = 'success';
            $results['message'] = 'Muy bien!! has obtenido <strong>'. $question->points .'</strong> puntos!';
            
        } else {
            $results['status'] = 'error';
            $results['message'] = 'Lo sentimos!! no has obtenido puntos...';
        }
        return $results;
    }

    public function start()
    {
        $questions = Question::whereNotIn('id', array_keys($this->session->questions))->get();
        if($questions->count()) $question = $questions->random();
        else return redirect('/games/trivia');

        return redirect('/games/trivia/questions/' . $question->id);
    }

    public function reset()
    {
        $this->session->questions = [];
        $this->session->save();
        return redirect('/games/trivia');
    }
}
