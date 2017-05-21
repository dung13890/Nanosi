@extends('layouts.frontend')

@section('page-content')
<div class="row">
    <div class="page-header">
        <h1>Hello <small>{{ $item->name }}</small></h1>
    </div>
    <div class="jumbotron">
        <h1>Hello, world!</h1>
        <p>...</p>
        <p><a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Sign In..</a></p>
    </div>
</div>
@endsection
