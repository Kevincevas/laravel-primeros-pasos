@extends('dashboard.layout')

@section('content')

    
    
    <div class="row">
        <a href="{{ route('post.create') }}">Crear</a>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Categoría</th>
                        <th>Posteado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($posts as $p)
                        <tr>
                            <td>{{$p->title}}</td>
                            <td>{{ $p->category->title }}</td>
                            <td>{{$p->posted}}</td>
                            <td>
                                <a href="{{ route('post.edit', $p) }}">Editar</a>
                                <a href="{{ route('post.show', $p) }}">Ver</a>
                                
                                <form action="{{ route('post.destroy', $p) }}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit">Eliminar</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        
            </table>

            {{ $posts->links() }}
            
            <br>
        </div>
        <div class="col-md-3"></div>
    </div>
    
@endsection