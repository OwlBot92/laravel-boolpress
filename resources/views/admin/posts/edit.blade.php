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
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" value="{{ old( 'content', $post->content ) }}"></textarea>
            </div>

            <input type="submit" value="Submit" class="btn btn-success">
        </form>

    </div>    



@endsection