<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{

    private $app_data;

    public function __construct()
    {
        $this->app_data = require(app_path('app_data.php'));
    }

    public function showData()
    {
        return response()->json($this->app_data);
    }

    public function startGame():View
    {
        return view('home');
    }

    public function prepareGame(Request $request)
    {
        //validaton
        $request->validate(
            [
                'total_questions' => 'integer|min:3|max:30|required'
            ],
            [
                'total_questions.required' => 'Campo obrigatório!',
                'total_questions.min' => 'Deve ter no mínimo :min questões!',
                'total_questions.max' => 'Deve ter no máximo :max questões!',
                'total_questions.integer' => 'Deve ser um número inteiro!'
            ]
        );
        //Catch number of questions
        $total_questions = intval($request->input('total_questions'));
        $quiz = $this->prepareQuiz($total_questions);

        dd($quiz);
    }

    private function prepareQuiz($total_questions)
    {
        $questions = [];
        $total_contries = count($this->app_data);
        $indexes = range(0, $total_contries -1);
        shuffle($indexes);
        $indexes = array_slice($indexes, 0, $total_questions);
        $question_number = 1;

        foreach ($indexes as $index) {
            $question['question_number'] = $question_number++;
            $question['country'] = $this->app_data[$index]['country'];  
            $question['capital'] = $this->app_data[$index]['capital'];
            $other_capitals = array_column($this->app_data, 'capital');
            shuffle($other_capitals);
            $question['wrong_answer'] = array_slice($other_capitals, 0 , 3);
            $question['correct'] = null;
            $questions[] = $question;

        }

        return $questions;
    }

}
