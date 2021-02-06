<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//CATEGORIAS
Route::group(['middleware' => ['auth:api','permission:Crear Categoria']], function () {
    Route::post('/categorias', 'CategoriaController@store')->name('categorias.store');
});
Route::group(['middleware' => ['auth:api','permission:Editar Categoria']], function () {
    Route::put( '/categorias/{id}', 'CategoriaController@update')->name('categorias.update');
});
Route::group(['middleware'=>['auth:api','permission:Mostrar Categoria']],function(){
Route::get('/categorias','CategoriaController@index')->name('categorias.index');
});

Route::group(['middleware'=>['auth:api','permission:ver Detalle Categoria']],function(){
    Route::get('/categorias/{id}','CategoriaController@show')->name('categorias.show');
});
Route::group(['middleware'=>['auth:api','permission:Eliminar Categoria']],function(){
    Route::delete('/categorias/{id}','CategoriaController@destroy')->name('categorias.destroy');
});


Route::post('/login','AuthController@login');

//CIUDADES

Route::group(['middleware' => ['auth:api','permission:Crear Ciudad']], function () {
    Route::post('/ciudades', 'CiudadController@store')->name('ciudades.store');
});
Route::group(['middleware' => ['auth:api','permission:Editar Ciudad']], function () {
    Route::put( '/ciudades/{id}', 'CiudadController@update')->name('ciudades.update');
});
Route::group(['middleware'=>['auth:api','permission:Mostrar Ciudad']],function(){
    Route::get('/ciudades','CiudadController@index')->name('ciudades.index');
});
Route::group(['middleware'=>['auth:api','permission:ver Detalle Ciudad']],function(){
    Route::get('/ciudades/{id}','CiudadController@show')->name('ciudades.show');
});

Route::group(['middleware'=>['auth:api','permission:Eliminar Ciudad']],function(){
    Route::delete('/ciudades/{id}','CiudadController@destroy')->name('ciudades.destroy');
});


//USUARIOS

Route::group(['middleware' => ['auth:api','permission:Crear Usuario']], function () {
    Route::post('/usuarios', 'UserController@store')->name('usuarios.store');
});

    Route::post('/usuariosSolicitante', 'UserController@storeSolicitante')->name('usuarios.store');

Route::group(['middleware' => ['auth:api','permission:Editar Usuario']], function () {
    Route::put( '/usuarios/{id}', 'UserController@update')->name('usuarios.update');
});
Route::group(['middleware'=>['auth:api','permission:Mostrar Usuario']],function(){
    Route::get('/usuarios','UserController@index')->name('usuarios.index');
});
Route::group(['middleware'=>['auth:api','permission:ver Detalle Usuario']],function(){
    Route::get('/usuarios/{id}','UserController@show')->name('usuarios.show');
});

Route::group(['middleware'=>['auth:api','permission:Eliminar Usuario']],function(){
    Route::delete('/usuarios/{id}','UserController@destroy')->name('usuarios.destroy');
});

//EMPLEOS
Route::group(['middleware'=>['auth:api','permission:Mostrar Empleo']],function(){
    Route::get('/empleos','EmpleoController@index')->name('empleos.index');
});
Route::group(['middleware' => ['auth:api','permission:Crear Empleo']], function () {
    Route::post('/empleos', 'EmpleoController@store')->name('empleos.store');
});
Route::group(['middleware' => ['auth:api','permission:Editar Empleo']], function () {
    Route::put( '/empleos/{id}', 'EmpleoController@update')->name('empleos.update');
});

Route::group(['middleware'=>['auth:api','permission:ver Detalle Empleo']],function(){
    Route::get('/empleos/{id}','EmpleoController@show')->name('empleos.show');
});

Route::group(['middleware'=>['auth:api','permission:Eliminar Empleo']],function(){
    Route::delete('/empleos/{id}','EmpleoController@destroy')->name('empleos.destroy');
});

Route::group(['middleware'=>['auth:api','permission:Mostrar Empleo Creador']],function(){
    Route::get('/empleoIdCreador/{id}','EmpleoController@empleoIdCreador')->name('empleos.empleoIdCreador');
});

//SIN ROLES
Route::group(['middleware'=>['auth:api','permission:Mostrar Empleo Solicitante']],function(){
    Route::get('/empleosusers/{id}','EmpleoUserController@show')->name('empleosusers.show');
});
Route::post('/empleoBuscador','EmpleoController@empleoBuscador')->name('empleos.empleoBuscador');
Route::get('/empleosIndex','EmpleoController@empleoIndex')->name('empleos.empleoIndex');
Route::get('/empleoId/{id}','EmpleoController@empleoId')->name('empleos.empleoId');
Route::get('/usuariosId/{id}','UserController@showId')->name('usuarios.showId');
Route::get('/ciudadesIndex','CiudadController@ciudadIndex')->name('ciudades.ciudadIndex');
Route::get('/categoriaIndex','CategoriaController@categoriaIndex')->name('categorias.categoriaIndex');


//CURRICULUMS
Route::group(['middleware' => ['auth:api','permission:Crear Curriculum']], function () {
    Route::post('/curriculums', 'CurriculumController@store')->name('curriculums.store');
});

Route::group(['middleware'=>['auth:api','permission:Editar Curriculum']],function () {
    Route::put('/curriculums/{id}', 'CurriculumController@update')->name('curriculums.update');
});

Route::group(['middleware'=>['auth:api','permission:Mostrar Curriculum']],function(){
    Route::get('/curriculums','CurriculumController@index')->name('curriculums.index');
});
Route::group(['middleware'=>['auth:api','permission:Mostrar Curriculum Solicitante']],function(){
    Route::get('/curriculumId/{id}','CurriculumController@curriculumId')->name('curriculums.curriculumId');
});

Route::group(['middleware'=>['auth:api','permission:ver Detalle Curriculum']],function(){
    Route::get('/curriculums/{id}','CurriculumController@show')->name('curriculums.show');
});

Route::group(['middleware'=>['auth:api','permission:Eliminar Curriculum']],function(){
    Route::delete('/curriculums/{id}','CurriculumController@destroy')->name('curriculums.destroy');
});


//Agregar empleo y usuarios
Route::group(['middleware' => ['auth:api','permission:Crear EmpleoUser']], function () {
    Route::post('/empleouser', 'EmpleoUserController@store')->name('empleouser.store');
});

//ROLES CATEGORIA EMPLEOS
Route::group(['middleware' => ['auth:api','permission:Crear CategoriaEmpleo']], function () {
    Route::post('/categoriaempleos', 'CategoriaEmpleoController@store')->name('categoriaempleos.store');
});
Route::group(['middleware' => ['auth:api','permission:Editar CategoriaEmpleo']], function () {
    Route::put( '/categoriaempleos/{id}', 'CategoriaEmpleoController@update')->name('ciudades.update');
});
Route::group(['middleware'=>['auth:api','permission:Mostrar CategoriaEmpleo']],function(){
    Route::get('/categoriaempleos','CategoriaEmpleoController@index')->name('ciudades.index');
});
Route::group(['middleware'=>['auth:api','permission:ver Detalle CategoriaEmpleo']],function(){
    Route::get('/categoriaempleos/{id}','CategoriaEmpleoController@show')->name('ciudades.show');
});

Route::group(['middleware'=>['auth:api','permission:Eliminar CategoriaEmpleo']],function(){
    Route::delete('/categoriaempleos/{id}','CategoriaEmpleoController@destroy')->name('ciudades.destroy');
});
