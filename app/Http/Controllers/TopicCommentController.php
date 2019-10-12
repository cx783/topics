<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicCommentController extends Controller
{
    public function store(Topic $topic, Request $request)
    {
        $validated = $request->validate([
            'body' => ['required', ['string']]
        ]);

        $comment = new Comment($validated);
        $comment->author()->associate(Auth::user());

        $topic->comments()->save($comment);

        return back()->with('message.success', 'Comment added');
    }
}
