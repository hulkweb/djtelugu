<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Song;
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

    public function show($id)
    {
        $data = array();
        $data['popular'] = Song::orderBy('views', 'desc')->take(10)->get();

        $data['songs'] = Song::where('category_id', $id)->get();
        $data['categories'] = Category::all();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = Setting::where("property", "site_title")->first()->value;
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
