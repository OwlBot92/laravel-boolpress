@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Posts</h1>


        <div class="row">
            @foreach ($posts as $post)
                <div class="col-6">
                    <div class="card" style="margin-bottom: 20px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            
                            {{-- VIEW POST --}}
                            <a href="{{ route('admin.posts.show', [ 'post' => $post->id ]) }}" class="btn btn-primary">View Post</a>
                            
                            {{-- EDIT POST --}}
                            <a href="{{ route('admin.posts.edit', [ 'post' => $post->id ]) }}" class="btn btn-success">Edit Post</a>
                            
                            {{-- DELETE POST --}}
                            <form style="display: inline-block;" action="{{route('admin.posts.destroy', ['post'=>$post->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete Post" class="btn btn-danger">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    



@endsection