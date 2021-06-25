@extends('layouts.app')

@section('content')
    <div class="container">
        
        <h1>Create new post</h1>

        <form action="{{ route('admin.posts.store') }}" method='post'>
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" class="form-control" id="title" aria-describedby="" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="content">Content: </label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
                <label for="category">Category: </label>
                <select class="form-control" name="category_id" id="">
                    <option value="0">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tags: </label>

                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <input type="submit" value="Submit" class="btn btn-success">
        </form>
    </div>    



@endsection