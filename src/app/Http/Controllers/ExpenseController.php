<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        if (! $user->colocation_id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|gt:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $categoryInColocation = \App\Models\Category::where('id', $validated['category_id'])
            ->where('colocation_id', $user->colocation_id)
            ->exists();

        if (! $categoryInColocation) {
            return back()->withErrors(['category_id' => 'Invalid category for your colocation.']);
        }

        $user->expenses()->create(array_merge($validated, [
            'colocation_id' => $user->colocation_id
        ]));

        return back()->with('status', 'Expense added.');
    }

    public function destroy(Request $request, Expense $expense)
    {
        $user = $request->user();

        if ((int) $expense->user_id !== (int) $user->id || (int) $expense->colocation_id !== (int) $user->colocation_id) {
            abort(403);
        }

        $expense->delete();

        return back()->with('status', 'Expense deleted.');
    }
}
