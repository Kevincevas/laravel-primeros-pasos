@csrf

<div>
    <label for="title">Categoría</label>
    <input class="form-control" type="text" value="{{old("title", $category->title)}}" name="title" id='title'>
</div>

<div>
    <label for="">Slug</label>
    <input class="form-control" {{ $category->slug == '' ? "" : 'readonly' }} type="text" value="{{old('slug', $category->slug)}}" name="slug">
</div>

<a class="btn btn-warning my-3" href="{{ route('category.index') }}">Cancelar</a>

<button class="btn btn-success mt-3" type="submit">Enviar</button>