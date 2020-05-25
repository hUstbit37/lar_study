<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\QlVideo;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data2=User::find(Auth::user()->id);
        $data=User::find(Auth::user()->id)->comment()->orderBy('created_at', 'desc')->paginate(4);
        $s=Comment::all();
        return view('home', compact('s', 'data2'));
    }
}
