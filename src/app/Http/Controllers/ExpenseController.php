<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user->colocation_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|gt:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        if (!Category::where('id', $validated['category_id'])->where('colocation_id', $user->colocation_id)->exists()) {
            return back()->withErrors(['category_id' => 'Invalid category.']);
        }

        DB::transaction(function () use ($user, $validated) {
            $user->expenses()->create(array_merge($validated, [
                'colocation_id' => $user->colocation_id
            ]));

            $members = User::where('colocation_id', $user->colocation_id)->get();
            $memberCount = $members->count();
            $share = $validated['amount'] / $memberCount;

            foreach ($members as $member) {
                if ($member->id === $user->id) {
                    $member->increment('balance', $validated['amount'] - $share);
                } else {
                    $member->decrement('balance', $share);
                }
            }
        });

        return back()->with('status', 'Expense added and balances updated.');
    }

    public function destroy(Request $request, Expense $expense)
    {
        $user = $request->user();

        if ((int)$expense->user_id !== (int)$user->id || (int)$expense->colocation_id !== (int)$user->colocation_id) {
            abort(403);
        }

        DB::transaction(function () use ($expense) {
            $members = User::where('colocation_id', $expense->colocation_id)->get();
            $memberCount = $members->count();
            $share = $expense->amount / $memberCount;

            foreach ($members as $member) {
                if ($member->id === $expense->user_id) {
                    $member->decrement('balance', $expense->amount - $share);
                } else {
                    $member->increment('balance', $share);
                }
            }

            $expense->delete();
        });

        return back()->with('status', 'Expense deleted and balances reverted.');
    }
}