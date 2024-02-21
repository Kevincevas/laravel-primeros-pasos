<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);
        echo view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // otra manera de listar las categorias
        // $categories = Category::get();


        //funcion pluck para listar las categorias
        $categories = Category::pluck('id','title');
        $post = new Post();
        // dd($categories);

        echo view('/dashboard/post/create', compact('categories','post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // echo request('title');
        // echo $request->input('slug');
        // dd($request->all());

        //Validacion
        // $validated = $request->validate([
        //     "title" => "required|min:5|max:500",
        //      "slug" => "required|min:5|max:500",
        //      "content" => "required|min:10",
        //      "category_id" => "required",
        //      "description" => "required|min:10",
        //      "posted" => "required",
        // ]);
        // dd($validated);

        //otra forma de validar
        // $request->validate(StoreRequest::myRules());

        // $data = array_merge($request->all(), ['image' => '']);
        
        Post::create($request->validated());

        // Redireccionar
        // redirect()->route("post.index");
        // redirect('/post/index');
        return to_route("post.index")->with('status','Registro Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        
        return view('/dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //funcion pluck para listar las categorias
        $categories = Category::pluck('id','title');
        echo view('/dashboard/post/edit', compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        $data = $request->validated();
        //validamos si la image esta definida
        if (isset($data["image"])) {
            $data["image"] = $filename = time().".".$data["image"]->extension();
            $request->image->move(public_path("images"),$filename);
        }

        $post->update($data);
        // $request->session()->flash('status','Registro Actualizado');
        return to_route("post.index")->with('status','Registro Actualizado');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        
        $post->delete();
        return to_route("post.index")->with('status','Registro Eliminado');

    }
}
