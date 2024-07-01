@extends('app')

@section('title')
    Users
@endsection

@section('content')
    <div class="container">
        <h1>Users</h1>
        <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">Add User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="fw-bold">
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->role->name }}
                        </td>
                        <td class="fw-bold">
                            {{ $user->email }}
                        </td>
                        <td>
                            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
