<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function index()
    {
        $responses = Response::with(['question.survey', 'user'])->latest()->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/Responses/Index', [
            'responses' => $responses,
            'can' => [
                'view' => Auth::user()->can('responses view'),
                'delete' => Auth::user()->can('responses delete'),
            ]
        ]);
    }

}
