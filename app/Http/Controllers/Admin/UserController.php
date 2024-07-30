<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;



class UserController extends Controller
{
        public function index()
        {
            $users = User::latest()->paginate(100)->onEachSide(2)->appends(request()->query());
            return Inertia::render('Admin/User/Index', [
                'users' => $users,
                'can' => [
                    'create' => Auth::user()->can('user create'),
                    'edit' => Auth::user()->can('user edit'),
                    'delete' => Auth::user()->can('user delete'),
                ]
            ]);
        }
    
        public function create()
        {
            $roles = Role::all();  // Fetch all roles
            return Inertia::render('Admin/User/create', [
                'roles' => $roles,
                
            ]);
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'string|required|max:30',
                'email' => 'string|required|unique:users',
                'password' => 'string|required',
                'role' => 'required',
            ]);

            $data = $request->all();
            $data['password'] = Hash::make($request->password);

            $user = User::create($data);

            $user->assignRole($request->input('role'));

            if ($user) {
                return redirect()->route('user.index')->with('success', 'Successfully added user');
            } else {
                return redirect()->route('user.index')->with('error', 'Error occurred while adding user');
            }
        }

        public function edit(User $user)
        {
            $roles = Role::all();
        
            return Inertia::render('Admin/User/edit', [
                'roles' => $roles,
                'user' => $user,
            ]);
        }

        public function update(Request $request, User $user)
        {
            $request->validate([
                'name' => 'string|required|max:30',
                'email' => 'string|required',
            ]);

            $data = $request->all();
            $user->update($data);
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->input('role'));

            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        }

        public function destroy(User $user)
        {
            if ($user->name === 'Administrator') {
                return redirect()->back()->with('error','Cannot delete the Administrator role.');
            }

            $user->delete();
            return redirect()->route('user.index')->with('success', 'user deleted successfully.');
        }
    
}
