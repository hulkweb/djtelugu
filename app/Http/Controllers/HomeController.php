<?php

namespace App\Http\Controllers;

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
        return view('index', ['title' => 'Chhavinirman - Social Media graphics']);
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
    {
        return view('terms', ['title' => 'Terms And Conditions | Chhavinirman']);
    }
    public function login()
    {
        return view('admin.login', ['title' => 'Terms And Conditions | Chhavinirman']);
    }
    public function privacy()
    {
        return view('privacy', ['title' => 'Privacy Policy | Chhavinirman']);
    }
    public function refund()
    {
        return view('refund', ['title' => 'Refund policy | Chhavinirman']);
    }
}
