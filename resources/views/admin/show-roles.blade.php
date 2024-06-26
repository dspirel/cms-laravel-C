@extends('app')

@section('title')
    Roles
@endsection

@section('content')
    <div class="container">
        <h1>Roles</h1>
        <a href="{{ route('role.create.show') }}" class="btn btn-primary">Add Role</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $p)
                                {{ $p->name }},
                            @endforeach
                        </td>
                        {{-- <td>
                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">TODO! Edit</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">TODO! Delete</button>
                            </form>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No roles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
