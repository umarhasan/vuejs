<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
class SurveyController extends Controller

{

    public function index()
        {
            $surveys = (new Survey)->newQuery();
            $surveys->latest();
            $surveys = $surveys->paginate(100)->onEachSide(2)->appends(request()->query());
          

            return Inertia::render('Admin/Surveys/Index', [
                'surveys' => $surveys,
                'can' => [
                    'create' => Auth::user()->can('surveys create'),
                    'edit' => Auth::user()->can('surveys edit'),
                    'delete' => Auth::user()->can('surveys delete'),
                ]
            ]);
        }
    

    public function create()
    {
        return Inertia::render('Admin/Surveys/create');
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string', 'status' => 'required|in:Draft,Active,Close']);
        $survey = Survey::create($request->all());
        return redirect()->route('admin.surveys.index');
    }

    public function show(Survey $survey)
    {
        return Inertia::render('Admin/Surveys/show', ['survey' => $survey]);
    }

    public function edit(Survey $survey)
    {
        return Inertia::render('Admin/Surveys/edit', ['survey' => $survey]);
    }

    public function update(Request $request, Survey $survey)
    {
        $request->validate(['title' => 'required|string', 'status' => 'required|in:Draft,Active,Close']);
        $survey->update($request->all());
        return redirect()->route('admin.surveys.index');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('admin.surveys.index');
    }
}
