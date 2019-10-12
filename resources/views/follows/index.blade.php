@extends('layouts.app')

@section('content')
    <div class="container">
        <follow-list :follows="{{ json_encode($follows) }}" :user="{{ json_encode(Auth::user()) }}"></follow-list>
    </div>
}@endsection
