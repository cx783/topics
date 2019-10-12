<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\Topic;
use App\Actions\CreateNewTopic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function index(Request $request)
    {
        $topics = $request->user()
            ->allTopics()
            ->with('author', 'comments.author')
            ->latest()
            ->paginate($request->input('per_page', 15));

        return Topic::collection($topics);
    }

    public function store(Request $request)
    {
        (new CreateNewTopic)->run($request->all());
    }
}
