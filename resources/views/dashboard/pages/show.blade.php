@extends('app')

@section('title')
    Page
@endsection

@section('content')
    <div class="container pt-5">
        <h1>{{ $page->title }}</h1>
        <h2>{{ $page->category->name }}</h2>

        <img src="{{ \App\Helpers\Image::get($page->image) }}" class="" alt="Page Image" width="128" height="128">

        <p>{{ $page->text_content }}</p>
    </div>
@endsection
