<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function index()
    {
        $follows = Auth::user()
            ->allFollows()
            ->get();

        return view('follows.index', compact('follows'));
    }
}
