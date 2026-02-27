<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|gt:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $request->user()->expenses()->create(array_merge($validated, [
            'colocation_id' => $request->user()->colocation_id
        ]));

        return back()->with('status', 'Expense added.');
    }

    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense); // Recommended: Use Policies
        $expense->delete();
        return back()->with('status', 'Expense deleted.');
    }
}
