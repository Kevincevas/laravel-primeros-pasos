@extends('dashboard.layout')

@section('content')
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>De Categoría: {{$category->title}}</h1>

            <p>{{ $category->slug }}</p>

        </div>
    </div>

@endsection