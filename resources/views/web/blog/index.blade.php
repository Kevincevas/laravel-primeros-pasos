@extends('web.layout')

@section('content')

    <x-web.blog.post.index :posts="$posts" >
        <h1>Listado principal de post</h1>

        {{-- Slot con nombre --}}
        @slot('header')
            <h1>Slot con nombre</h1>
        @endslot

        @slot('footer')
            <h1>Slot footer</h1>
        @endslot

        {{-- Slot in line --}}
        @slot('extra', 'slot extra')

    </x-web.blog.post.index>
@endsection