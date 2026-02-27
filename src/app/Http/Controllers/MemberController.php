<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function invite(Request $request)
    {
        $owner = $request->user();

        if (! $owner->colocation_id || $owner->colocation_role !== 'owner') {
            abort(403);
        }

        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $member = User::where('email', $validated['email'])->firstOrFail();

        if ((int) $member->id === (int) $owner->id) {
            return back()->withErrors(['email' => 'You cannot invite yourself.']);
        }

        if ($member->colocation_id && (int) $member->colocation_id !== (int) $owner->colocation_id) {
            return back()->withErrors(['email' => 'User is already in another colocation.']);
        }

        $member->update([
            'colocation_id' => $owner->colocation_id,
            'colocation_role' => 'member',
        ]);

        return back()->with('status', 'Member added to your colocation.');
    }

    public function destroy(Request $request, User $member)
    {
        $owner = $request->user();

        if (! $owner->colocation_id || $owner->colocation_role !== 'owner') {
            abort(403);
        }

        if ((int) $member->colocation_id !== (int) $owner->colocation_id) {
            abort(403);
        }
        
        if ($member->colocation_role === 'owner') {
            return back()->withErrors(['member' => 'Cannot remove owner from colocation.']);
        }
        
        $member->update(['colocation_id' => null, 'colocation_role' => null]);
        return back()->with('status', 'Member removed.');
    }

    // You can add your invite logic here too!
}