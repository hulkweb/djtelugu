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

        $data = [

            'songs' => $songs,
            'categories' => $categories,
        ];
        return view('admin.index', $data);
    }
}
