<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $users = User::orderBy('name', 'asc')->get();
        return view('admin.dashboard', ['active' => 'admin', 'rooms' => $rooms, 'users' => $users]);
    }
}
