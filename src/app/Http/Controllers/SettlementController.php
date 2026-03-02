<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettlementController extends Controller
{
    /**
     * Process a virtual settlement: create the record and zero the balances.
     */
    public function markAsPaid(Request $request): RedirectResponse
    {
        $user = $request->user();

        // 1. Validate the incoming virtual data from the form
        $validated = $request->validate([
            'owes_user_id' => 'required|exists:users,id',
            'receives_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|gt:0',
        ]);

        // 2. Security: Only the person RECEIVING the cash should confirm this
        if ((int)$validated['receives_user_id'] !== (int)$user->id) {
            abort(403, 'Only the receiver can confirm they got the money.');
        }

        // 3. Execute the transfer in a transaction
        DB::transaction(function () use ($validated, $user) {
            // Create the permanent history record
            Settlement::create([
                'owes_user_id' => $validated['owes_user_id'],
                'receives_user_id' => $validated['receives_user_id'],
                'amount' => $validated['amount'],
                'colocation_id' => $user->colocation_id,
                'is_paid' => true,
            ]);

            // UPDATE BALANCES:
            // The one who owed (-10) gets +10 to reach 0
            User::where('id', $validated['owes_user_id'])->increment('balance', $validated['amount']);
            
            // The one who received (+10) gets -10 to reach 0
            User::where('id', $validated['receives_user_id'])->decrement('balance', $validated['amount']);
        });

        return back()->with('status', 'Settlement finalized. Balances have been synchronized.');
    }
}