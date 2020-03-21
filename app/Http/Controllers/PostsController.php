<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        //pluck means i want only their user_id
        $users = auth()->user()->following()->pluck('profiles.user_id');

         //where user_id in $users ** with('user') means with user relation from Post model to fix N+1 query proplem
         // (limit 1 proplem)
        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);  
        
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }   

    public function create()
    {
        return view('posts.create');
    }
    
    public function store()
    {
        $data = request()->validate([
            'caption'=>'required',
            'image'=>'required|image',
        ]);

        $imagePath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        return redirect('/profile/'.auth()->user()->id);    
    }
    public function show(\App\Post $post)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains( $post->user->id) : false;
        return view('posts.show',[
            'post' => $post,
            'follows' => $follows,
        ]);
    }
}
