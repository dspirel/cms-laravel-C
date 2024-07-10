@extends('app')

@section('title')
    Pages
@endsection

@section('content')
    <div class="container">
        <h1>Pages</h1>
        <a href="{{ route('dashboard.pages.create') }}" class="btn btn-primary">Create page</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Created by</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td class="fw-bold">
                            {{ $page->title }}
                        </td>
                        <td class="fw-bold">
                            {{ $page->category->name }}
                        </td>
                        <td>
                            {{ $page->user->name }}
                        </td>
                        <td>
                            <a href="{{ route('dashboard.pages.show', $page->id) }}" class="btn btn-primary">Show</a>
                        </td>
                        <td>
                            <a href="{{ route('dashboard.pages.edit', $page->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
