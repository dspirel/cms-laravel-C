@extends('app')

@section('title')
    Edit page
@endsection

@section('content')
    <div class="container pt-5">
        <h2 class="p-2">Edit page</h2>

        <form action="{{ route('dashboard.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="d-inline-flex p-2">
                <label for="title">Title:</label>
                <input type="text" name="title" max="32" required value="{{ $page->title }}"/>
            </div>

            <div class="d-inline-flex p-2">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="d-inline-flex p-2" style="height: 256px">
                <label for="title">Content:</label>
                <textarea cols="30" rows="10" name="text_content" size="128" required>{{ $page->text_content }}</textarea>
            </div>
            <ul>
                @foreach ($categories as $cat)
                    <li>
                        <input type="radio" name="category_id" value="{{ $cat->id }}"
                            @if ($page->category_id == $cat->id) return @checked(true) @endif>
                        <label for="category_id"> {{ $cat->name }} </label>
                    </li>
                @endforeach
            </ul>
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>

        <form action="{{ route('dashboard.pages.destroy', $page->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
