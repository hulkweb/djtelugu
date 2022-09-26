<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array();

        $data['songs'] = Song::orderBy('id', 'desc')->take(20)->get();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = Setting::where("property", "site_title")->first()->value;
        $data['categories'] = Category::orderBy('id', 'desc')->take(10)->get();
        $data['popular'] = Song::orderBy('views', 'desc')->take(10)->get();

        return view('index', $data);
    }

    public function logout_user()
    {
        auth()->logout();
        return redirect('/');
    }
    public function authenticate()
    {
        $user = User::where('email', request('email'))->where('password', request('password'))->count();
        if ($user) {
            $user = User::where('email', request('email'))->where('password', request('password'))->get()[0];
            Auth::login($user);

            if ($user->admin) {
                return redirect('/admin');
            } else if ($user->reseller) {
                return redirect('/reseller');
            } else {
                return redirect('/');
            }
        }
        return redirect('/login')->with('errore', 'Incorrect Credentials');
    }
    public function terms()
    { $data = array();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = "Terms And Conditions";
        return view('terms', $data);
    }
    public function login()
    {
        return view('admin.login', ['title' => 'login']);
    }
    public function privacy()
    {    $data = array();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = "Privacy Policy";
        return view('privacy',  $data);
    }
    public function about()
    {    $data = array();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = "About Us";
        return view('about',  $data);
    }
    public function desclaimer()
    {    $data = array();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = "Desclaimer";
        return view('desclaimer',  $data);
    }
    public function contact()
    {    $data = array();
        $data['site_url'] = Setting::where("property", "site_url")->first()->value;
        $data['site_title'] = "Reach Out to us";
        return view('contact',  $data);
    }
}
