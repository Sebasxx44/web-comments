<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PageController extends Controller
{
    
    public function dashboard(Request $request)
    {


        if($request->get('for-my')){

            $user = $request->user();
            $users_id = $user->friends()->pluck('id')->push($user->id);
            $posts = Post::whereIn('user_id', $users_id)->latest()->with('user')->get();

        }else{
            $posts = Post::latest()->with('user')->get();
        }
        
        return view('dashboard', compact('posts'));
    }

    public function profile(User $user)
    {
        $posts = $user->posts()->latest()->with('user')->get();

        return view('profile', compact('user', 'posts'));
    }

    public function status(Request $request)
    {
        $requests = $request->user()->pendingTo;
        $sent = $request->user()->pendingFrom;
        $friends = $request->user()->friends();

        return view('status', compact('requests', 'sent', 'friends'));
    }
    

}
