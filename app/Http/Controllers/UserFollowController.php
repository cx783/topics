<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

// This class should be work wiht Auth::user?
class UserFollowController extends Controller
{
    public function store(User $user, Request $request)
    {
        $validate = $request->validate([
            'follow_id' => ['required', 'exists:users,id']
        ]);

        $user->follows()->attach($request->input('follow_id'), ['is_active' => 1]);

        return \redirect()->route('follows.index');
    }

    public function destroy(User $user, Request $request)
    {
        $user->follows()->detach($request->input('follow_id'));

        return \redirect()->route('follows.index');
    }
}
