@extends('dashboard.layout')

@section('content')

    @include('dashboard.fragment._errors-form')
        
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Crear Post</h1>
        </div>
    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $e)
            <div class="error">
                {{ $e }}
            </div>
        @endforeach
        
    @endif

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 justify-center">
            <form action="{{ route("post.store") }}" method="post">
                @include('dashboard.post._form')
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection