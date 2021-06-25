@extends('layouts.app')

@section('content')
    
    <div class="container">

        @if ($post_category)
            <div class="mt-2 mb-2"><b>Category: </b> {{ $post_category->name }}</div>
        @endif

        <h1>{{ $post->title }}</h1>

        {{-- SLUG da aggiungere --}}

        <p>{{ $post->content }}</p>

        <div class="mt-2 mb-2">
            <span><b>Tags:</b></span>
            
            @foreach ($post_tags as $tag)
                
                {{ $tag->name }} 
                {{ $loop->last ? '' : ', ' }}
            @endforeach
        </div>
        
    </div>    



@endsection