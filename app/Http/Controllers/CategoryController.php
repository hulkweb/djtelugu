<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = array();
        $data['categories'] = Category::all();
        return view('admin.category.index', $data);
    }
    public function create()
    {
        $data = array();

        return view('admin.category.create', $data);
    }

    public function show($slug)
    {
        $title = str_replace('-', ' ', $slug);
        $data = array();
        $data['category'] = Category::where('title', $title)->first();
        return view('admin.category.show', $data);
    }

    public function store()
    {
        $request = request();
        $category = new Category();



        $category->title = $request->input('title');
        $category->details = $request->input('details');

        $category->save();
        return redirect()->back()->with('success', 'Uploaded Successfully');
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function edit($id)
    {
        $data = array();
        $data['category'] = Category::find($id);
        return view('admin.category.edit', $data);
    }
}
