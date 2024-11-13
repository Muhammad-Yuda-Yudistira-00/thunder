<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use Spatie\Permission\Models\Role;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $users = User::where('name', '!=', 'Super Admin')->orderBy('name', 'asc')->get();
        $roles = Role::where('name', '!=', 'super-admin')->orderBy('id', 'desc')->pluck('name');

        return view('admin.dashboard', ['active' => 'admin', 'rooms' => $rooms, 'users' => $users, 'roles' => $roles]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'role' => 'required'
        ]);

        $user = User::find($validated['user_id']);
        $user->syncRoles($validated['role']);

        return back()->with([
            'success' => "User role updated successfully!",
        ]);
    }
}
