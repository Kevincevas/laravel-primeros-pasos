{{-- <div {{$attributes->merge([ 'class' => 'py-3' ])}} > --}}

<div {{$attributes->class([ 'py-3' ])}} >

    <h1>{{$post->title}}</h1>
    <p>{{$post->created_at}}</p>
    <p>{{$post->content}}</p>

</div>