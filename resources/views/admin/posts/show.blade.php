@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>

        {{-- SLUG da aggiungere --}}

        <p>{{ $post->content }}</p>


        
    </div>    



@endsection