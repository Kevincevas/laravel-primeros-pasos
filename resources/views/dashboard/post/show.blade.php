@extends('dashboard.layout')

@section('content')
        
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>De Post: {{ $post->title }}</h1>

            <p>{{ $post->description }}</p>
            <p>{{ $post->posted }}</p>

            <div>{{ $post->content }}</div>
        </div>
    </div>

    
@endsection