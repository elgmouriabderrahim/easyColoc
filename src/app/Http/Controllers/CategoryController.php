<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        if ($request->user()->colocation_role !== 'owner') abort(403);
        $request->validate(['name' => 'required|unique:categories,name']);
        
        Category::create($request->only('name'));
        return back()->with('status', 'Category created.');
    }
}