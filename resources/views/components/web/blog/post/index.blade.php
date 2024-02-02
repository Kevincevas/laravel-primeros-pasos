
{{$slot}}

{{-- {{$header}} --}}
    
@foreach ($posts as $p)
    <div class="card card-white mb-2">
        <h3>
            {{$p->title}}
            <a href="{{ route("web.blog.show", $p) }}">Ir</a>
            {{$p->description}}
        </h3>
    </div>

    
@endforeach

{{-- {{$extra}} --}}

{{-- pagination --}}
{{$posts->links()}}

{{-- {{$footer}} --}}