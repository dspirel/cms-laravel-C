@extends('app')

@section('title')
    Update navigation button
@endsection

@section('content')
    <div class="container pt-5">
        <h2>Update navigation button</h2>

        <form action="{{ route('dashboard.navigation.update', $navigation->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="d-inline-flex p-2">
                <label for="name">Name:</label>
                <input type="text" name="name" max="32" required value="{{ $navigation->name }}"/>
            </div>
            <div class="d-inline-flex p-2">
                <p>Use "," to separate users.</p>
                <label for="from_user" class="form-label">Users:</label>
                <input type="text" class="form-control" name="from_user" value="{{ $navigation->from_user }}">
            </div>
            <div class="d-inline-flex p-2">
                <ul>
                    @foreach ($categories as $cat)
                        <li>
                            <input type="checkbox" name="{{ $cat->name }}" value="{{ $cat->id }}"
                                @foreach ($current_categories as $cc)
                                    @if ($cat->id == $cc)
                                        return @checked(true)
                                    @endif @endforeach />
                            <label for="{{ $cat->name }}"> {{ $cat->name }} </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
        <form action="{{ route('dashboard.navigation.destroy', $navigation->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
