<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller
{
    
    public function store(Request $request, User $user)
    {
        $authUser = $request->user();

        // Verificar si ya existe una relación de amistad en cualquier dirección
        $is_from = $authUser->from()->where('to_id', $user->id)->exists();
        $is_to = $authUser->to()->where('from_id', $user->id)->exists();

        if ($is_from || $is_to) {
            return back()->with('message', 'You are already friends or the request is pending.');
        }

        if ($authUser->id === $user->id) {
            return back()->with('message', 'You cannot add yourself as a friend.');
        }

        $authUser->from()->attach($user);

        return back()->with('message', 'Friend request sent.');
    }

    public function update(Request $request, User $user)
    {
        $authUser = $request->user();
        $authUser->pendingTo()->updateExistingPivot($user->id, ['accepted' => true]);
    
        return back()->with('message', 'Friend request accepted.');
    }
    


}
