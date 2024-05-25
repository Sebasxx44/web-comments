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

            $friends_from_ids = $user->friendsFrom()->pluck('users.id');
            $friends_to_ids = $user->friendsTo()->pluck('users.id');
            $users_id = $friends_from_ids->merge($friends_to_ids)->push($user->id);

            $posts = Post::whereIn('user_id', $users_id)->latest()->get();

        }else{
            $posts = Post::latest()->get();
        }
        
        return view('dashboard', compact('posts'));
    }

    public function profile(User $user)
    {
        $posts = $user->posts()->latest()->get();

        return view('profile', compact('user', 'posts'));
    }

    public function status(Request $request)
    {
        $requests = $request->user()->pendingTo;
        $sent = $request->user()->pendingFrom;

        return view('status', compact('requests', 'sent'));
    }
    

}
