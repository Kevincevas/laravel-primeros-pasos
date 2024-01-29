@csrf
        
<div>
    <label for="">Titulo</label>
    <input class="form-control" type="text" name="title" value="{{ old("title", $post->title) }}">
</div>

<div>
    <label for="">Slug</label>
    <input class="form-control" {{ $post->slug == '' ? "" : 'readonly' }} type="text" name="slug" value="{{ old("slug", $post->slug) }}">
</div>

<div>
    <label for="">Categoria</label>
    <select class="form-control" name="category_id">
        <option value="">-- Seleccione una Categoria --</option>
        @foreach ($categories as $title => $id)
            <option {{ old("category_id", $post->category_id) == $id ? "selected" : "" }} value="{{ $id }}">{{ $title }}</option>
        @endforeach
    </select>
</div>

<div>
    <label for="">Posteado</label>
    <select class="form-control" name="posted" id="">
        <option {{ old("posted", $post->posted) == "not" ? "selected" : "" }} value="not">No</option>
        <option {{ old("posted", $post->posted) == "yes" ? "selected" : "" }} value="yes">Si</option>
    </select>
</div>

<div>
    <label for="">Contenido</label>
    <textarea class="form-control" name="content">{{old("content", $post->content)}}</textarea>
</div>

<div>
    <label for="">Descripcion</label>
    <textarea class="form-control" name="description">{{old("description", $post->description)}}</textarea>
</div>

<br>

@if (isset($task) && $task == "edit")
    <div>
        <label for="">Imagen</label>
        <input type="file" name="image">
    </div>
@endif

<a class="btn btn-warning my-3" href="{{ route('post.index') }}">Cancelar</a>

<button class="btn btn-success mt-3" type="submit">Enviar</button>