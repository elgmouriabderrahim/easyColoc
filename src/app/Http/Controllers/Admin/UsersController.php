<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function toggleBan(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot ban yourself.');
        }

        $user->update([
            'is_banned' => !$user->is_banned
        ]);

        $status = $user->is_banned ? 'banned' : 'unbanned';
        return back()->with('success', "User has been successfully {$status}.");
    }
}
