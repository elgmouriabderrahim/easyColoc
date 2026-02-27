<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function destroy(Request $request, User $member)
    {
        if ($request->user()->colocation_role !== 'owner') abort(403);
        
        $member->update(['colocation_id' => null, 'colocation_role' => null]);
        return back()->with('status', 'Member removed.');
    }

    // You can add your invite logic here too!
}