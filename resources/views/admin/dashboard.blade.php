@extends('app')

@section('title')
    Dashboard
@endsection

@section('content')
<div>
    <h1>Hello {{ auth()->user()->name }}</h1>
</div>
@endsection
