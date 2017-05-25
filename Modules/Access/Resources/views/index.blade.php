@extends('access::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('access.name') !!}
    </p>
    <form action="/access/user" method="post">
        {{ csrf_field() }}
        <button type="submit">ASD</button>
    </form>
@stop
