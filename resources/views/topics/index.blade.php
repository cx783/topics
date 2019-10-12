@extends('layouts.app')

@section('content')
  <div class="container">
    <topic-list :topics="{{ json_encode($topics->items()) }}"></topic-list>
    {{ $topics->links() }}
  </div>
@endsection