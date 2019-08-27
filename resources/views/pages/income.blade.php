@extends('layout.app')
@section('content')
    <h1>Income</h1>
    <a href="/income/create" class="btn btn-primary">New</a>
    {{ Form::open(['url' => 'foo/bar']) }}
        
    {{ Form::close() }}
@endsection