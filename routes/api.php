<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\inventarioController;
Route::get('/Inventario', [inventarioController::class, 'index']);


Route::get('/Inventario¿', function(){
    return 'Obteniendo un producto de inventario ' ;
   });
Route::post('/Inventario', [inventarioController::class, 'store']);

   Route::put('/Inventario', function(){
    return 'Actualizando inventario' ;
   });
   Route::delete('/Inventario', function(){
    return 'Eliminar inventario' ;
   });

