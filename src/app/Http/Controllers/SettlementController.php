<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function markAsPaid(Request $request, Settlement $settlement): RedirectResponse
    {
        $user = $request->user();

        if (! $user->colocation_id) {
            abort(403);
        }

        $isParticipant = (int) $settlement->owes_user_id === (int) $user->id
            || (int) $settlement->receives_user_id === (int) $user->id;

        if (! $isParticipant || (int) $settlement->colocation_id !== (int) $user->colocation_id) {
            abort(403);
        }

        if (! $settlement->is_paid) {
            $settlement->update(['is_paid' => true]);
        }

        return back()->with('status', 'Settlement marked as paid.');
    }
}
