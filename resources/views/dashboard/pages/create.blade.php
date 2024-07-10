@extends('app')

@section('title')
    Create Page
@endsection

@section('content')
    <div class="container pt-5">
        <h2>New page</h2>

        <form action="{{ route('dashboard.pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="d-inline-flex p-2">
                <label for="title">Title:</label>
                <input type="text" name="title" max="32" required />
            </div>
            <div class="d-inline-flex p-2">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="d-inline-flex p-2" style="height: 256px">
                <label for="title">Content:</label>
                <textarea cols="30" rows="10" name="text_content" size="128" required></textarea>
            </div>
            <ul>
                @foreach ($categories as $cat)
                    <li>
                        <input type="radio" name="category_id" value="{{ $cat->id }}">
                        <label for="category_id"> {{ $cat->name }} </label>
                    </li>
                @endforeach
            </ul>

            <button type="submit" class="btn btn-primary mt-2">Create</button>
        </form>
    </div>
@endsection
