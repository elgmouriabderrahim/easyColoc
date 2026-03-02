<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
{
    $user = $request->user()->load('colocation');

    if (!$user->colocation_id || !$user->colocation || $user->colocation->status !== 'active') {
        return view('dashboard', [
            'hasColocation' => false,
            'categories' => collect(),
            'stats' => ['balance' => 0, 'total_spent' => 0]
        ]);
    }

    $colocation = Colocation::with('users')->findOrFail($user->colocation_id);
    
    $categories = Category::where('colocation_id', $colocation->id)->orderBy('name')->get();

    $expenses = Expense::with(['user', 'category'])
        ->where('colocation_id', $colocation->id)
        ->orderByDesc('date')
        ->orderByDesc('id')
        ->paginate(15);

    $totalHouseSpent = (float) Expense::where('colocation_id', $colocation->id)->sum('amount');
    

    $currentBalance = (float) $user->balance;

    $members = $colocation->users->where('balance', '!=', 0);

    $debtors = $members->where('balance', '<', 0)->sortBy('balance'); 
    $creditors = $members->where('balance', '>', 0)->sortByDesc('balance');

    $settlements = collect();

    $tempCreditors = $creditors->map(fn($u) => (object)[
        'id' => $u->id, 
        'full_name' => $u->full_name, 
        'balance' => (float) $u->balance
    ])->values();

    foreach ($debtors as $debtor) {
        $amountOwed = abs((float) $debtor->balance);

        foreach ($tempCreditors as $creditor) {
            if ($amountOwed <= 0 || $creditor->balance <= 0) continue;

            $transfer = min($amountOwed, $creditor->balance);

            $settlements->push((object)[
                'id' => null,
                'owes_user_id' => $debtor->id,
                'receives_user_id' => $creditor->id,
                'owes' => (object)['full_name' => $debtor->full_name],
                'receives' => (object)['full_name' => $creditor->full_name],
                'amount' => $transfer,
                'is_paid' => false,
                'created_at' => now(),
            ]);

            $amountOwed -= $transfer;
            $creditor->balance -= $transfer;
        }
    }

    return view('dashboard', [
        'hasColocation' => true,
        'colocation' => $colocation,
        'categories' => $categories,
        'expenses' => $expenses,
        'members' => $colocation->users,
        'settlements' => $settlements,
        'stats' => [
            'total_spent' => round($totalHouseSpent, 2),
            'balance' => $currentBalance,
        ],
    ]);
}
}