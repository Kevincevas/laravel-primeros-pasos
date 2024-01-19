@csrf

<div>
    <label for="title">Categoría</label>
    <input class="form-control" type="text" value="{{old("title", $category->title)}}" name="title" id='title'>
</div>

<div>
    <label for="">Slug</label>
    <input class="form-control" {{ $category->slug == '' ? "" : 'readonly' }} type="text" value="{{old('slug', $category->slug)}}" name="slug">
</div>

<br>
<button class="btn btn-info" type="submit">Enviar</button>