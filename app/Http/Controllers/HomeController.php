<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(5 , ['*'] , 'post');
        $users = User::paginate(5, ['*'] , 'user');
        return view('welcome',[
            'posts' => $posts,
            'users' => $users,
        ]);
    }
}
