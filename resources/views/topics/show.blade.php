@extends('layouts.app')

@section('content')
    <div class="container">
        <topic :topic="{{ json_encode($topic) }}"
            :editable="{{ $topic->user_id === Auth()->user()->id ? 'true' : 'false' }}"
            :deletable="{{ $topic->user_id === Auth()->user()->id  ? 'true' : 'false' }}"
            :commentable="true"
        ></topic>
    </div>
@endsection