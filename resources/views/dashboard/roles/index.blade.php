@extends('app')

@section('title')
    Roles
@endsection

@section('content')
    <div class="container">
        <h1>Roles</h1>
        <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary">Add Role</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td class="fw-bold">{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $p)
                                {{ $p->name }},
                            @endforeach
                        </td>
                        <td class="fw-bold {{ $role->active ? 'text-success' : 'text-danger' }}">
                            {{ $role->active ? 'Yes' : 'No' }}
                        </td>
                        <td>
                            @if ($role->name == 'user' || $role->name == 'admin') @continue
                            @endif
                            <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
                {{-- @empty
                    <tr>
                        <td colspan="9">No roles found.</td>
                    </tr>
                @endforelse --}}
            </tbody>
        </table>
    </div>
@endsection
