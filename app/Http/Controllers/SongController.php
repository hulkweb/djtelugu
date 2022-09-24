<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function show($id, $title)
    {

        $data = array();
        $data['song'] = Song::find($id);
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = Setting::where("property", "site_title")->first()->value;
        $data['categories'] = Category::orderBy('id', 'desc')->take(10)->get();
        $data['related'] = Song::where('category_id', Song::find($id)->category_id)->orderBy('id', 'desc')->take(10)->get();
        return view('admin.song.show', $data);
    }
    public function search()
    {
        $query = request("q");

        $data = array();
        $data['songs'] = DB::table('songs')->where('title', 'LIKE', "%$query%")->get();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = Setting::where("property", "site_title")->first()->value;
        return view('admin.category.show', $data);
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
        } finally {
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
