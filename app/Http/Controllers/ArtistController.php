<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $data = array();
        $data['artists'] = Artist::all();
        return view('admin.artist.index', $data);
    }
    public function create()
    {
        $data = array();

        return view('admin.artist.create', $data);
    }

    public function show($slug)
    {
        $title = str_replace('-', ' ', $slug);
        $data = array();
        $data['artist'] = Artist::where('title', $title)->first();
        return view('admin.artist.show', $data);
    }

    public function store()
    {
        $request = request();
        $artist = new Artist();

        $artist->name = $request->input('name');
        $artist->details = $request->input('details');
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $image_file = uniqid() .  $file->getClientOriginalExtension();
            $image_file_size = $file->getSize();
            $artist->image_file = $image_file;

            $file->move('uploads/artists/', $image_file);
        }
        $artist->save();
        return redirect()->back()->with('success', 'Uploaded Successfully');
    }

    public function delete($id)
    {
        Artist::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function edit($id)
    {
        $data = array();
        $data['artist'] = Artist::find($id);
        return view('admin.artist.edit', $data);
    }
}
