<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $songs = Song::count();
        $categories = Category::count();
        $downloads = 0;
        $views = 0;
        foreach (Song::all() as $song) {
            $downloads += $song->downloads;
        }
        foreach (Song::all() as $song) {
            $views += $song->views;
        }
        $data = [

            'songs' => $songs,
            'downloads' => $downloads,
            'views' => $views,
            'categories' => $categories,
        ];
        return view('admin.index', $data);
    }
}
