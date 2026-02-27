<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        if (! $user->colocation_id || $user->colocation_role !== 'owner') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->where(fn ($query) => $query->where('colocation_id', $user->colocation_id)),
            ],
        ]);

        Category::create([
            'name' => $validated['name'],
            'colocation_id' => $user->colocation_id,
        ]);

        return back()->with('status', 'Category created.');
    }

    public function destroy(Request $request, Category $category)
    {
        $user = $request->user();

        if (! $user->colocation_id || $user->colocation_role !== 'owner') {
            abort(403);
        }

        if ((int) $category->colocation_id !== (int) $user->colocation_id) {
            abort(403);
        }

        $category->delete();

        return back()->with('status', 'Category deleted.');
    }
}