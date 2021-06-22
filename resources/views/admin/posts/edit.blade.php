@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica Post: {{ $post->title }}</h1>


        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method='post'>
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title: </label> 
                <input type="text" class="form-control" id="title" aria-describedby="" name="title" value="{{ old( 'title', $post->title ) }}">
            </div>

            <div class="form-group">
                <label for="content">Content: </label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" >{{ old( 'content', $post->content ) }}</textarea>
            </div>  

            <div class="form-group">
                <label for="category">Edit Category: </label>
                <select class="form-control" name="category_id" id="">
                    <option value="0">Nessuna</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" value="Edit Post" class="btn btn-success">
        </form>

    </div>    



@endsection