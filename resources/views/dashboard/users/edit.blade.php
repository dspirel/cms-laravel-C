@extends('app')

@section('title')
    Edit user
@endsection

@section('content')
    <div class="container pt-5">
        <h2 class="p-2">Edit user</h2>

        <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="d-inline-flex p-2">
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" required/>
            </div>

            <div class="p-2">
                <label for="email">Email: </label>
                <input type="email" name="email" value="{{ $user->email }}" required/>
            </div>

            <div class="d-inline-flex p-2">
                <ul>
                    @foreach ($roles as $role)
                        <li>
                            <input type="radio" name="role" value="{{ $role->id }}"
                            @if ($user->role_id == $role->id) return @checked(true)
                            @endif>
                                {{-- @foreach ($current_permissions as $cp)
                                    @if ($p->id == $cp->id)
                                        return @checked(true)
                                    @endif @endforeach /> --}}
                            <label for="role"> {{ $role->name }} </label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>

        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
