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
                            <a href="#" class="btn btn-primary">View Post</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    



@endsection