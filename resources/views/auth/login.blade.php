@extends('app')

@section('title')
    Login
@endsection

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="pw">Password</label>
                <input name="password" type="password" class="form-control" id="pw" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
@endsection
