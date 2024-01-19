@extends('dashboard.layout')

@section('content')
    
    <div class="row">
        <a href="{{ route('category.create')}}">Crear</a>

        <div class="col-md-3"></div>
        
        <div class="col-md-6">
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Slug</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $c)
                        <tr>
                            <td>{{$c->title}}</td>
                            <td>{{$c->slug}}</td>
                            <td>
                                <a href="{{ route('category.edit', $c) }}">Editar</a>
                                <a href="{{ route('category.show', $c) }}">Ver</a>

                                <form action="{{ route('category.destroy', $c) }}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                            
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
        
        <div class="col-md-3"></div>
    </div>


@endsection