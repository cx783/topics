<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Actions\CreateNewTopic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $topics = Auth::user()
            ->allTopics()
            ->with('author', 'comments.author')
            ->latest()
            ->paginate($request->input('per-page', 15));

        return view('topics.index', compact('topics'));
    }

    public function store(Request $request)
    {
        (new CreateNewTopic)->run($request->all());
    }

    public function show(Topic $topic)
    {
        $topic->load(['author', 'comments.author']);

        return view('topics.show', compact('topic'));
    }
}
