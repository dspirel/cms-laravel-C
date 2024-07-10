@extends('app')

@section('title')
    Create navigation button
@endsection

@section('content')
    <div class="container pt-5">
        <h2>New navigation button</h2>

        <form action="{{ route('dashboard.navigation.store') }}" method="POST">
            @csrf

            <div class="d-inline-flex p-2">
                <label for="name">Name:</label>
                <input type="text" name="name" max="32" required />
            </div>
            <div class="d-inline-flex p-2">
                <p>Use "," to separate users.</p>
                <label for="from_user" class="form-label">Users:</label>
                <input type="text" class="form-control" name="from_user">
            </div>
            <div class="d-inline-flex p-2">
                <ul>
                    @foreach ($categories as $cat)
                        <li>
                            <input type="checkbox" name="{{ $cat->name }}" value="{{ $cat->id }}" />
                            <label for="{{ $cat->name }}"> {{ $cat->name }} </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </form>
    </div>
@endsection
