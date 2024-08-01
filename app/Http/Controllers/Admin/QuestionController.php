<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Survey;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->paginate(100)->onEachSide(2)->appends(request()->query());
        return Inertia::render('Admin/Questions/Index', [
            'questions' => $questions,
            'can' => [
                'create' => Auth::user()->can('questions create'),
                'edit' => Auth::user()->can('questions edit'),
                'delete' => Auth::user()->can('questions delete'),
            ]
        ]);
    }
    
    public function create(Survey $survey)
    {
        return Inertia::render('Admin/Questions/create', ['survey' => $survey]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'question_type' => 'required|in:Text,Radio',
            'survey_id' => 'required|exists:surveys,id'
        ]);

        Question::create($request->all());
        return redirect()->route('questions.index')->with('success', 'Question created successfully.');
    }

    public function edit(Question $question)
    {
        return Inertia::render('Admin/Questions/edit', ['question' => $question]);
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'name' => 'required|string',
            'question_type' => 'required|in:Text,Radio'
        ]);

        $question->update($request->all());
        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }

    public function manageOptions(Question $question)
    {
        $options = $question->options;
        return Inertia::render('Admin/Questions/ManageOptions', ['question' => $question, 'options' => $options]);
    }
}
