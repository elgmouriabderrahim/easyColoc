<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ColocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        if ($request->user()->colocation_id) return back()->withErrors(['colocation' => 'Already in a colocation.']);

        $colocation = Colocation::create([
            'name' => $request->name,
            'invite_token' => $this->generateUniqueInviteToken(),
            'status' => 'active',
        ]);

        $request->user()->update(['colocation_id' => $colocation->id, 'colocation_role' => 'owner']);
        return redirect()->route('dashboard')->with('status', 'Colocation created!');
    }

    public function join(Request $request)
    {
        $request->validate(['invite_token' => 'required|string']);
        $colocation = Colocation::where('invite_token', $request->invite_token)->where('status', 'active')->firstOrFail();

        $request->user()->update(['colocation_id' => $colocation->id, 'colocation_role' => 'member']);
        return redirect()->route('dashboard');
    }

    public function leave(Request $request)
    {
        $user = $request->user();
        if ($user->colocation_role === 'owner') return back()->withErrors(['msg' => 'Owners must cancel.']);
        
        $user->update(['colocation_id' => null, 'colocation_role' => null]);
        return redirect()->route('dashboard');
    }

    public function cancel(Request $request)
    {
        $user = $request->user();

        if (! $user->colocation_id || $user->colocation_role !== 'owner') {
            abort(403);
        }

        $colocation = Colocation::findOrFail($user->colocation_id);

        DB::transaction(function () use ($colocation) {
            User::where('colocation_id', $colocation->id)
                ->update(['colocation_id' => null, 'colocation_role' => null]);

            $colocation->update(['status' => 'cancelled']);
        });

        return redirect()->route('dashboard')->with('status', 'Colocation cancelled.');
    }

    public function regenerateInviteToken(Request $request)
    {
        $user = $request->user();

        if (! $user->colocation_id || $user->colocation_role !== 'owner') {
            abort(403);
        }

        $colocation = Colocation::findOrFail($user->colocation_id);
        $colocation->update(['invite_token' => $this->generateUniqueInviteToken()]);

        return back()->with('status', 'Invite token regenerated.');
    }

    private function generateUniqueInviteToken(): string
    {
        do { $token = Str::upper(Str::random(10)); } 
        while (Colocation::where('invite_token', $token)->exists());
        return $token;
    }
}
