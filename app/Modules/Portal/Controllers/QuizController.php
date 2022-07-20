<?php

namespace App\Modules\Portal\Controllers;

use App\Bll\Lang;
use App\Http\Controllers\Controller;
use App\Modules\Admin\Models\Products\Question;
use App\Modules\Admin\Models\Products\Answer;
use App\Modules\Admin\Models\Products\QuestionDetails;
use Illuminate\Http\Request;

class QuizController extends Controller
{


    protected function index()
    {
        $test = [];
        $question_details = QuestionDetails::first();
        $count = Question::count();

        for ($i = 0; $i < $count; $i++) {
            $questions = Question::with('data')->skip($i)->take(1)->first();
            $test[$i] = $questions;
        }

        return view('site.questions.index', compact('test', 'question_details'));
    }

    protected function store(Request $request)
    {

//         dd($request->all());
        // if ($request->has('published')) {


        // }
        foreach ($request->question_id as $question_id) {


                $answer = Answer::query()->create([

                    'answer' => $request->answer,
                    'question_id' => $question_id,
                ]);
        }



        if ($answer) {
            return redirect()->back()->with('success', _i('Your request is sent successfully !'));
        } else {
            return redirect()->back()->with('error', _i('Error occured, please try again later'));
        }
    }
}
