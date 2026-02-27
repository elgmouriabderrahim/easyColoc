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
        
        $categories = Category::orderBy('name')->get();

        if (! $user->colocation_id || ! $user->colocation || $user->colocation->status !== 'active') {
            return view('dashboard', [
                'hasColocation' => false,
                'categories' => $categories,
            ]);
        }

        $colocation = Colocation::with('users')->findOrFail($user->colocation_id);
        $memberIds = $colocation->users->pluck('id');

        $expenses = Expense::with(['user', 'category'])
            ->where('colocation_id', $colocation->id)
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate(15);

        $totalSpent = (float) Expense::where('colocation_id', $colocation->id)->sum('amount');
        $userPaid = (float) Expense::where('colocation_id', $colocation->id)
            ->where('user_id', $user->id)
            ->sum('amount');
            
        $memberCount = max($colocation->users->count(), 1);
        $share = round($totalSpent / $memberCount, 2);

        $settlements = Settlement::with(['owes', 'receives'])
            ->where(fn($q) => $q->where('owes_user_id', $user->id)->orWhere('receives_user_id', $user->id))
            ->whereIn('owes_user_id', $memberIds)
            ->whereIn('receives_user_id', $memberIds)
            ->latest()
            ->get();

        return view('dashboard', [
            'hasColocation' => true,
            'colocation' => $colocation,
            'categories' => $categories,
            'expenses' => $expenses,
            'members' => $colocation->users,
            'settlements' => $settlements,
            'stats' => [
                'total_spent' => round($totalSpent, 2),
                'balance' => round($userPaid - $share, 2),
            ],
        ]);
    }
}