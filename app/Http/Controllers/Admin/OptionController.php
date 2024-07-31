<?php

namespace App\Http\Controllers\Admin;
    
use App\Http\Controllers\Controller;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class OptionController extends Controller
{
   
    public function index(Question $question)
    {
        $options = $question->options()->latest()->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Options/Index', [
            'options' => $options,
            'question' => $question,
            'can' => [
                'create' => Auth::user()->can('options create'),
                'edit' => Auth::user()->can('options edit'),
                'delete' => Auth::user()->can('options delete'),
            ],
        ]);
    }

    public function create(Question $question)
    {
        return Inertia::render('Admin/Options/create', ['question' => $question]);
    }

    public function store(Request $request, Question $question)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $question->options()->create($request->all());
        return redirect()->route('admin.questions.options.index', $question);
    }

    public function edit(Question $question, Option $option)
    {
        return Inertia::render('Admin/Options/edit', ['question' => $question, 'option' => $option]);
    }

    public function update(Request $request, Question $question, Option $option)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $option->update($request->all());
        return redirect()->route('admin.questions.options.index', $question);
    }

    public function destroy(Question $question, Option $option)
    {
        $option->delete();
        return redirect()->route('admin.questions.options.index', $question);
    }
}
