<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
//        $categories = Category::query()->where('user_id', '=', Auth::user()->id)->paginate();
        $categories = Auth::user()->categories()->paginate(5);

        return view('categories.list', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('categories', 'name')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);

        $category = Category::query()->create([
            'name' => $request->input('category_name'),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('message', 'Category added!');
    }


    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        if ($category->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'category_name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('categories', 'name')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                }),
            ],
        ]);

        $result = $category->update([
            'name' => $request->input('category_name'),
        ]);
        return redirect()->route('categories.index')->with('message', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');

    }
}
