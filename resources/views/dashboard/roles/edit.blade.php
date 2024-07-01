@extends('app')

@section('title')
    Edit role
@endsection

@section('content')
    <div class="container pt-5">
        <h2 class="p-2">Edit role</h2>

        <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <p class="p-2">Role name: {{ $role->name }}</p>

            <div class="d-inline-flex p-2">
                <label for="name">New role name:</label>
                <input type="text" name="name" value="{{ $role->name }}" required/>
            </div>

            <div class="p-2">
                <label for="active">Active: </label>
                <input type="checkbox" name="active"
                    @if ($role->active) return @checked(true) @endif />
            </div>

            <div class="d-inline-flex p-2">
                <ul>
                    @foreach ($permissions as $p)
                        <li>
                            <input type="checkbox" name="{{ $p->name }}" value="{{ $p->id }}"
                                @foreach ($current_permissions as $cp)
                                    @if ($p->id == $cp->id)
                                        return @checked(true)
                                    @endif @endforeach />
                            <label for="{{ $p->name }}"> {{ $p->name }} </label>
                        </li>
                        <p>{{ $p->description }}</p>
                    @endforeach
                </ul>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>

        <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
