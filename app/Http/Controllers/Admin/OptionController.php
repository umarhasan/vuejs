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
   
    public function index()
    {   
        $options = Option::with('question')->latest()->paginate(100)->onEachSide(2)->appends(request()->query());
    
        // Collect all options from the questions
        $questions = $options->getCollection()->flatMap->question;
    
        return Inertia::render('Admin/Options/Index', [
            'questions' => $questions,
            'options' => $options,
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'question_id' => 'required|exists:questions,id'
        ]);

        Option::create($request->all());
        return redirect()->route('options.index')->with('success', 'Option created successfully.');
    }

    public function edit(Option $option)
    {
        return Inertia::render('Admin/Options/edit', ['option' => $option]);
    }

    public function update(Request $request, Option $option)
    {
        $request->validate(['name' => 'required|string']);
        $option->update($request->all());
        return redirect()->route('options.index')->with('success', 'Option updated successfully.');
    }

    public function destroy(Option $option)
    {
        $option->delete();
        return redirect()->route('options.index')->with('success', 'Option deleted successfully.');
    }
}


