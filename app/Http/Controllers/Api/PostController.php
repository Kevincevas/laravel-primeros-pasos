<?php

// php artisan make:controller Api/PostController -m Post

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::with('category')->paginate(5));
    }

    public function all()
    {
        return response()->json(Post::get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json( Post::create($request->validated()) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    //buscar registro por el slug forma 1
    // public function slug($slug)
    // {
    //     $post = Post::with("category")->where("slug", $slug)->firstOrFail();
    //     //$post->category;
    //     return response()->json($post);
    // }

    //buscar registro por el slug forma 2 -> api.php
    public function slug(Post $post)
    {
        // $post = Post::with("category")->where("slug", $slug)->firstOrFail();
        $post->category;
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        // $data = $request->validated();
         //validamos si la image esta definida
        // if (isset($data["image"])) {
        //     $data["image"] = $filename = time().".".$data["image"]->extension();
        //     $request->image->move(public_path("images"),$filename);
        // }

        // $post->update($data);
        
        $post->update($request->validated());
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json("ok");
    }
}
