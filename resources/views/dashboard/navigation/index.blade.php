@extends('app')

@section('title')
    Navigation
@endsection

@section('content')
    <div class="container">
        <h1>Navigation</h1>
        <a href="{{ route('dashboard.navigation.create') }}" class="btn btn-primary">Create navigation button</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($navigations as $nav)
                    <tr>
                        <td class="fw-bold">
                            {{ $nav->name }}
                        </td>
                        <td>
                            <a href="{{ route('dashboard.navigation.edit', $nav->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
