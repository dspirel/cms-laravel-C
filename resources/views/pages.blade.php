@extends('app')

@section('title')
    Pages
@endsection

@section('content')
    <div class="container">
        @foreach ($pages as $page)
        <div class="container pt-5">
            <h2>{{ $page->title }}</h2>
            <h3>{{ $page->category->name }}</h3>

            <img src="{{ \App\Helpers\Image::get($page->image) }}" class="" alt="Page Image" width="128" height="128">

            <p>{{ $page->text_content }}</p>
            <p>-------------------------------------------------------------</p>
        </div>
        @endforeach
    </div>
@endsection
