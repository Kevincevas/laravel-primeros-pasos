<?php

use App\Http\Controllers\Dashboard\PostController;
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


Route::get('/', function(){
    return view('welcome');
});

// Ruta de tipo recurso: contiene las rutas de tipo crud en una sola linea de codigo
Route::resource('post', PostController::class);

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