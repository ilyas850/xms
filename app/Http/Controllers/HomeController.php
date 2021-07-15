<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
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
        $role = Auth::user()->role;
        if($role == "1"){
            return redirect()->to('admin');
        } else if($role == "2"){
            return redirect()->to('psikolog');
        } else if($role == "3"){
              return redirect()->to('peserta');
        } else {
            return redirect()->to('logout');
        }
    }
}
