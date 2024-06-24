@extends('app')

@section('title')
    Dashboard
@endsection

@section('content')
<<<<<<< cms-users-func
    <div class="container">
        <div class="flex-column justify-content-center">
            <div class="p-2">
                <h1>Dashboard</h1>
            </div>
            <div class="p-2">
                <h1>Hello {{ auth()->user()->role_id }}</h1>
            </div>
        </div>
    </div>
=======
<div>
    <h1>Hello {{ auth()->user()->name }}</h1>
</div>
>>>>>>> dev
@endsection
