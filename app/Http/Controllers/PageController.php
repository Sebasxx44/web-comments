<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PageController extends Controller
{
    
    public function dashboard(Request $request)
    {

        if($request->get('for-my')){
            $posts = $request->user()->posts()->latest()->get(); 
        }else{
            $posts = Post::latest()->get();
        }
        
        return view('dashboard', compact('posts'));
    }

}
