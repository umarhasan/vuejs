<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Response;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    public function index()
    {
        $responses = Response::with(['question.survey', 'user'])->latest()->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Responses/Index', [
            'responses' => $responses,
            'can' => [
                'create' => Auth::user()->can('responses create'),
                'edit' => Auth::user()->can('responses edit'),
                'show' => Auth::user()->can('responses show'),
                'delete' => Auth::user()->can('responses delete'),
            ]
        ]);
    }

    public function create()
    {
        $questions = Question::all();  // Assuming you want to list questions for the response
        return Inertia::render('Admin/Responses/create', [
            'questions' => $questions
        ]);
    }

   

   
    public function store(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'question_id' => 'required|exists:questions,id',
            'response' => 'required|string',
            'total_questions' => 'required|integer',
            'completed_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = new Response;
        $response->question_id = $request->input('question_id');
        $response->user_id = Auth::id();  // Assuming the user is logged in and you're tracking which user responded
        $response->response = $request->input('response');
        $response->total_questions = $request->input('total_questions');
        $response->completed_at = $request->input('completed_at');
        $response->save();

        return redirect()->route('responses.index')->with('success', 'Response saved successfully.');
    }

   

    public function edit(Response $response)
    {
        // Ensure to load necessary data
        $response->load('question.survey');
        return Inertia::render('Admin/Responses/edit', [
            'response' => $response,
            'questions' => Question::all()  // Load all questions if needed for changing the question of a response
        ]);
    }

    public function update(Request $request, Response $response)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required|exists:questions,id',
            'response' => 'required|string',
            'total_questions' => 'required|integer',
            'completed_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::user()->can('responses edit')) {
            $response->update($request->only(['question_id', 'response', 'total_questions', 'completed_at']));
            return redirect()->route('responses.index')->with('success', 'Response updated successfully.');
        }
        return redirect()->back()->withErrors('You do not have permission to edit responses.');
    }


    public function show(Response $response)
{
    $response->load('question.survey.questions.responses');

    return Inertia::render('Admin/Responses/show', [
        'response' => $response,
        'questions' => $response->question->survey->questions,
        'total_questions' => $response->question->survey->total_questions, // Corrected accessor usage
        'responses' => $response->question->responses
    ]);
}

    public function destroy(Response $response)
    {
        if (Auth::user()->can('responses delete')) {
            $response->delete();
            return redirect()->route('responses.index')->with('success', 'Response deleted successfully.');
        }
        return redirect()->back()->withErrors('You do not have permission to delete responses.');
    }
}
