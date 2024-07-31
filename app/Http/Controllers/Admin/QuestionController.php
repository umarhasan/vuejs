<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(Survey $survey)
    {
        $questions = $survey->questions()->latest()->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Questions/Index', [
            'questions' => $questions,
            'survey' => $survey,
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

    public function store(Request $request, Survey $survey)
    {
        $request->validate([
            'name' => 'required|string',
            'question_type' => 'required|in:Text,Radio',
        ]);
        $survey->questions()->create($request->all());
        return redirect()->route('admin.surveys.questions.index', $survey);
    }

    public function edit(Survey $survey, Question $question)
    {
        return Inertia::render('Admin/Questions/edit', ['survey' => $survey, 'question' => $question]);
    }

    public function update(Request $request, Survey $survey, Question $question)
    {
        $request->validate([
            'name' => 'required|string',
            'question_type' => 'required|in:Text,Radio',
        ]);
        $question->update($request->all());
        return redirect()->route('admin.surveys.questions.index', $survey);
    }

    public function destroy(Survey $survey, Question $question)
    {
        $question->delete();
        return redirect()->route('admin.surveys.questions.index', $survey);
    }
}
