<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


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
        if(auth::user()->user_type=='employer'){
            return redirect()->to('/company/create');
        }
        if(auth::user()->user_type=='seeker'){
            return redirect()->to('/user/profile');
        }
        $adminRole = Auth::user()->roles()->pluck('name');
        if($adminRole->contains('admin')){
            return redirect('/dashboard');

        }

        return view('home');
    }
}
