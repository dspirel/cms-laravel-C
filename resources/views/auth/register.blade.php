@extends('app')

@section('title')
    Register
@endsection

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Username</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Enter username" required maxlength="16">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="pw">Password</label>
                <input name="password" type="password" class="form-control" id="pw" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="cpw">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" id="cpw" placeholder="Confirm password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
@endsection
