@extends('app')

@section('title')
    Create role
@endsection

@section('content')
    <div class="container pt-5">
        <h2>New Role</h2>

        <form action="{{ route('dashboard.roles.store') }}" method="POST">
            @csrf

            <div class="d-inline-flex p-2">
                <label for="name">Role name:</label>
                <input type="text" name="name" required/>
            </div>
            <div class="d-inline-flex p-2">
                <ul>
                    @foreach ($permissions as $p)
                        <li>
                            <input type="checkbox" name="{{ $p->name }}" value="{{ $p->id }}" />
                            <label for="{{ $p->name }}"> {{ $p->name }} </label>
                            <p>{{ $p->description }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </form>
    </div>
@endsection
