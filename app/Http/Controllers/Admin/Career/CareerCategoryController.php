<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerCategory;

class CareerCategoryController extends Controller
{
    public function index()
    {
        $categories = CareerCategory::all();
        return view('Admin.Career.Category.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.Career.Category.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'category' => 'required|string|max:255',
    ]);

    CareerCategory::create([
        'category' => $request->category,
    ]);

    return redirect()->route('Admin.Career.Category.index')->with('success', 'Category created successfully.');
}

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = CareerCategory::findOrFail($id);
        return view('Admin.Career.Category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $category = CareerCategory::findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect()->route('Admin.Career.Category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = CareerCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('Admin.Career.Category.index')->with('success', 'Category deleted successfully.');
    }
}