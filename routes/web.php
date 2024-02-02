<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\BlogController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth',"admin"]], function() { //middelware para proteger la ruta
    
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class,
    ]);
});

Route::group(['prefix' => 'blog'], function () {

    Route::controller(BlogController::class)->group(function(){
        Route::get('/', "index")->name("web.blog.index");
        Route::get('/{post}', "show")->name("web.blog.show");

    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Ruta de tipo recurso: contiene las rutas de tipo crud en una sola linea de codigo
// Route::resource('post', PostController::class);
// Route::resource('category', CategoryController::class);

// Rutas de tipo recurso, mas de una 
// Route::resources([
//     'post' => PostController::class,
//     'category' => CategoryController::class,
// ]);

// Rutas tradicionales
// Route::get('post', [PostController::class, 'index']);
// Route::get('post/{post}', [PostController::class, 'show']);
// Route::get('post/create', [PostController::class, 'create']);
// Route::get('post/{post}/edit', [PostController::class, 'edit']);
// Route::post('post', [PostController::class, 'store']);
// Route::put('post/{post}', [PostController::class, 'update']);
// Route::delete('post/{post}', [PostController::class, 'delete']);


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/contacto', function () {
//     return view('contacto');
// })->name('contacto');

// Route::get('/custom', function () {
//     $msj = 'Mensaje desde el servidor';
//     return view('custom', ['msj' => $msj, 'msj2' => 20]);
// });

//unir metodos get y post cuando sea la misma ruta
// Route::match(['get','post'], '/contacto', function(){
//     return "Hola desde la pagina usando el metodo get o post";
// });

// Route::get('/contacto', function () {
//     return "hola desde la pag de contacto usando get"; 
// });

// Route::get('/cursos/informacion', function() {
//     return "Aqui podras encontrar toda la informacion de los cursos";
// });

//pasando un parametro
// Route::get('/cursos/{id}', function($id) {
//     return "Bienvenido al curso con el id: $id";
// });


//pasando dos parametros
// Route::get('/cursos/{curso}/{category}', function($curso, $category) {
//     return "Bienvenido al curso: $curso, de la categoria: $category";
// });

//pasando parametros opcionales
// Route::get('/cursos/{curso}/{category?}', function($curso, $category = null) {
//     if ($category) {
//         return "Bienvenido al curso: $curso, de la categoria: $category";
//     } else {
//         return "Bienvenido al curso: $curso";
//     }
// });