<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    ////////////////////////////////////////////////////////
    // Testing purposes
    /////////////

    // this function only for test the users page
    public function users_page() {
        return view('/users');
    }

    // this function only for test the tasks page
    public function tasks_page() {
        return view('/tasks');
    }

    /////////////////////////////////////////////////////////
}
