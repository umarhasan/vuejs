<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Load user with roles and permissions if not null
        if ($user) {
            $user->load('roles','roles.permissions');
            $user->allPermissions = $user->getAllPermissions()->pluck('name'); // This gets all unique permissions
        }


        return Inertia::render('Dashboard', [
            'auth' => [
                'user' => $user,
                'permissions' => $user->allPermissions ?? []
            ]
        ]);
    }
}
