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
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth::user()->user_type=='employer')
        {
            return redirect()->to('/company/create');
        }
        $adminrole=Auth::user()->roles()->pluck('name');
        if($adminrole->contains('admin'))
        {
            return redirect()->to('/dashboard');
        }
        $jobs=Auth::user()->favorites;
        return view('home',compact('jobs'));
    }
}
