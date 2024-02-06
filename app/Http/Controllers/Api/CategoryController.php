<?php

// php artisan make:controller Api/CategoryController -m Category

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::paginate(5));
    }

    public function all()
    {
        return response()->json(Category::get());
    }

    //buscar registro por el slug
    public function slug($slug)
    {
        $category = Category::where("slug", $slug)->firstOrFail();
        return response()->json($category);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json( Category::create($request->validated()) );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json("ok");
    }

    // funcion para llamar los posts de una categoria
    public function posts(Category $category)
    {
        // query builder: conjunto de funciones para arma la query
        // $posts = Post::join('categories',"categories.id","=","posts.category_id")
        // ->select("posts.*", "categories.title as categoriy")
        // ->where("categories.id", $category->id)
        // ->get();
        //->toSql();

        // Eloquent
        $posts = Post::with("category")
        ->where("category_id", $category->id)
        ->get();
        // ->toSql();


        return response()->json($posts);
    }
}
