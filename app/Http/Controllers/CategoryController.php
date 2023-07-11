<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Flash;

class CategoryController extends Controller
{   
    public function __construct()
{
    $this->middleware('checkuseremail');
}

    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'description' => 'required',
        ]);

        $category = new Category([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        $category->save();
        Flash::success('Model created successfully!');
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }
    public function edit($id){
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
    ]);

    $category = Category::findOrFail($id);
    $category->name = $request->name;
    $category->description = $request->description;
    $category->save();

    Flash::success('Model update successfully!');
    return redirect()->route('category.index')->with('success', 'Category updated successfully.');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    
    // Detach all related posts
    $category->posts()->detach();
    
    // Now, delete the category itself
    $category->delete();
    Flash::success('Model Deleted successfully!');
    return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
}
}
