<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::user();
        // return view('user.index', ['user' => $user]);
        $user = Auth::user();
        if($user->role == 'Admin')
        {
            return view('admin.home');
        }
        else
        {
            return view('user.index', ['user' => $user]); 
        }
    }

    // public function adminHome()
    // {
    //     return view('admin.home');
    // }
}
