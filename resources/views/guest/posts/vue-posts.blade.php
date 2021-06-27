@extends('layouts.app')


@section('header-scripts')
    {{-- axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- VUE --}}
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        
        {{-- VUE root --}}
        <div id="root">
            <h1> @{{ title }}</h1>

            <div class="row">
                <div class="col-4" v-for="post in posts">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">@{{ post.title }}</h5>
                            <p class="card-text">@{{ post.content }}</p>
                            {{-- <a href="#" class="btn btn-primary"></a> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>    

@endsection