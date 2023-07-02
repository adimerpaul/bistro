<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('login', [App\Http\Controllers\UserController::class, 'login']);
Route::get('verificarComunicacion', [\App\Http\Controllers\ActivityController::class,'verificarComunicacion']);
Route::post('upload/{type}/{id}', [\App\Http\Controllers\UploadController::class,'upload']);
Route::get('genXML/{id}', [\App\Http\Controllers\SaleController::class,'genXML']);

Route::get('anularMasivo', [\App\Http\Controllers\FacturaController::class,'anularMasivo']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('getYearMonthFacturas', [\App\Http\Controllers\FacturaController::class,'getYearMonthFacturas']);
    Route::post('import', [\App\Http\Controllers\FacturaController::class,'import']);
    Route::get('buscarFacturas',[App\Http\Controllers\FacturaController::class,'buscarFacturas']);
    Route::post('getYearMonthFacturas', [\App\Http\Controllers\FacturaController::class,'getYearMonthFacturas']);
    Route::post('import', [\App\Http\Controllers\FacturaController::class,'import']);

    Route::post('eventSearch', [\App\Http\Controllers\SaleController::class, 'eventSearch']);

    Route::post('me', [App\Http\Controllers\UserController::class, 'me']);
    Route::post('logout', [App\Http\Controllers\UserController::class, 'logout']);
    Route::apiResource('user', App\Http\Controllers\UserController::class);
    Route::put('/updatePassword/{user}',[\App\Http\Controllers\UserController::class,'updatePassword']);
    Route::put('/updatepermisos/{user}',[\App\Http\Controllers\UserController::class,'updatepermisos']);
    Route::resource('/permiso',\App\Http\Controllers\PermisoController::class);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class);
    Route::apiResource('products', \App\Http\Controllers\ProductController::class);
    Route::get('productSFilter/{category_id}', [\App\Http\Controllers\ProductController::class,'productSFilter']);
    Route::post('listado', [\App\Http\Controllers\ReportController::class,'listado']);
    Route::get('datocine/{id}', [\App\Http\Controllers\ReportController::class,'datocine']);
    Route::get('motivoanular', [\App\Http\Controllers\ReportController::class,'motivoanular']);
    Route::resource('cui', \App\Http\Controllers\CuiController::class);
    Route::resource('cufd', \App\Http\Controllers\CufdController::class);
    Route::resource('activity', \App\Http\Controllers\ActivityController::class);
    Route::resource('document', \App\Http\Controllers\DocumentController::class);
    Route::resource('eventoSignificativo', \App\Http\Controllers\EventoSignificativoController::class);
    Route::get('motivoanular', [\App\Http\Controllers\ActivityController::class,'motivoanular']);
    Route::post('recepcionPaqueteFactura', [\App\Http\Controllers\EventoSignificativoController::class,'recepcionPaqueteFactura']);
    Route::post('cantidadFacturas', [\App\Http\Controllers\EventoSignificativoController::class,'cantidadFacturas']);
    Route::post('validarPaquete', [\App\Http\Controllers\EventoSignificativoController::class,'validarPaquete']);

    Route::post('anularSale', [\App\Http\Controllers\SaleController::class,'anularSale']);
    Route::resource('event', \App\Http\Controllers\EventController::class);
    Route::resource('client', \App\Http\Controllers\ClientController::class);
    Route::resource('sale', \App\Http\Controllers\SaleController::class);

    Route::post('listleyenda', [\App\Http\Controllers\ActivityController::class,'listleyenda']);
    Route::post('searchClient', [\App\Http\Controllers\ClientController::class,'searchClient']);
    Route::get('validarTarjeta/{cod}', [\App\Http\Controllers\SaleController::class, 'validarTarjeta']);

    Route::post('usercaja', [\App\Http\Controllers\ReportController::class, 'usercaja']);
    Route::post('resumen', [\App\Http\Controllers\ReportController::class, 'resumen']);
    Route::post('resumenRF', [\App\Http\Controllers\ReportController::class, 'resumenRF']);
    Route::post('caja', [\App\Http\Controllers\ReportController::class, 'caja']);
    Route::post('cajaF', [\App\Http\Controllers\ReportController::class, 'cajaF']);
    Route::post('cajaR', [\App\Http\Controllers\ReportController::class, 'cajaR']);

    Route::post('enviarCorreo', [\App\Http\Controllers\SaleController::class,'enviarCorreo']);
    Route::post('eventSearch', [\App\Http\Controllers\SaleController::class, 'eventSearch']);

});
