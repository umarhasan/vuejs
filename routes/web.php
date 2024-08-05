<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ResponseController;

use App\Http\Controllers\DashboardController;

use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';    

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
    'middleware' => ['auth'],
], function () {
    // Admin-specific routes
    Route::group(['middleware' => 'role:admin'], function () {
        Route::resource('role', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('surveys', SurveyController::class);
        Route::resource('questions', QuestionController::class);
        Route::resource('options', OptionController::class);
        Route::resource('responses', ResponseController::class);
        
        Route::get('survey/{survey}/questions', [SurveyController::class, 'manageQuestions'])->name('surveys.manage.questions');
        Route::get('question/{survey}/new', [QuestionController::class, 'create'])->name('question.new');
        Route::get('question/{question}/options', [QuestionController::class, 'manageOptions'])->name('questions.manage.options');
        Route::get('question/{question}/create', [OptionController::class,'create'])->name('options.new');
        Route::get('responses', [ResponseController::class, 'index'])->name('responses.index');
    });

    // User and Admin-specific routes
    Route::group(['middleware' => 'role:user,admin'], function () {
        Route::resource('user', UserController::class);
        Route::resource('posts', PostController::class);
        Route::resource('responses', ResponseController::class);
        Route::resource('surveys', SurveyController::class)->only(['index', 'show']);
        Route::get('survey/{survey}/questions/{question}', [QuestionController::class, 'show'])->name('surveys.questions.show');
        Route::post('responses', [ResponseController::class, 'store'])->name('responses.store');
    });
});