@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica Post: {{ $post->title }}</h1>


        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method='post' enctype="multipart/form-data">
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

            <div class="form-group">
                <label>Tags: </label>

                @foreach ($tags as $tag)
                    <div class="form-check">
                        
                        @if ($errors->any())
                            <input class="form-check-input" name="tags[]" type="checkbox" 
                            value="{{ $tag->id }}" 
                            id="tag-{{ $tag->id }}"
                            {{ in_array($tag->id, old('tags', [] )) ? 'checked' : '' }}>
                        @else
                            <input class="form-check-input" name="tags[]" type="checkbox" 
                            value="{{ $tag->id }}" 
                            id="tag-{{ $tag->id }}"
                            {{ $post->tags->contains($tag->id) ? 'checked' : ''}}>
                        @endif

                    
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label for="cover-image">Banner Image</label>
                <input type="file" class="form-control-file" id="cover-image" name="cover-image">
            </div>

            @if ($post->cover)
                <div class="mb-3">
                    <h3>Old image</h3>
                    <img style="max-width: 300px" src="{{ asset('storage/' . $post->cover) }}" alt="">
                </div>
            @endif

            <input type="submit" value="Edit Post" class="btn btn-success">
        </form>

    </div>    



@endsection