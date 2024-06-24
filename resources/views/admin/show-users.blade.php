@extends('app')

@section('title')
    Users
@endsection

@section('content')
    <div class="container">
        <div class="flex-column justify-content-center">
            <div class="p-2">
                <h1>Users</h1>
            </div>
            <div class="p-2">
                @foreach ($users as $user)
                    <p>User: {{ $user->name }}</p>
                @endforeach
            </div>
        </div>
    </div>
@endsection
