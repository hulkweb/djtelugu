<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        try {
            $data = array();
            $data['songs'] = Song::all();
            return view('admin.song.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('errore', $e->getMessage());
        }
    }
    public function create()
    {
        $data = array();
        $data['categories'] = Category::all();
        return view('admin.song.create', $data);
    }

    public function show($slug)
    {
        $title = str_replace('-', ' ', $slug);
        $data = array();
        $data['song'] = Song::where('title', $title)->first();
        return view('admin.song.show', $data);
    }

    public function store()
    {
        try {
            $request = request();
            $song = new Song();
            if ($request->hasFile('audio_file')) {
                $file = $request->file('audio_file');
                $audio_file = uniqid() .  $file->getClientOriginalExtension();
                $song->audio_file = $audio_file;
                $song->audio_file_size = $file->getSize();
                $file->move('uploads/songs/', $audio_file);
            }

            if ($request->hasFile('image_file')) {
                $file = $request->file('image_file');
                $image_file = uniqid() .  $file->getClientOriginalExtension();
                $image_file_size = $file->getSize();
                $song->image_file = $image_file;
                $song->image_file_size = $file->getSize();
                $file->move('uploads/images/', $image_file);
            }

            $song->title = $request->input('title');
            $song->description = $request->input('description');
            $song->category_id = $request->input('category_id');
            $song->save();
            return redirect()->back()->with('success', 'Uploaded Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('errore', $e->getMessage());
        }
    }

    public function delete($id)
    {
        Song::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function edit($id)
    {
        $data = array();
        $data['song'] = Song::find($id);
        return view('admin.song.edit', $data);
    }
}
