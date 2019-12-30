<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Language select
Route::get('lang/{locale}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);

// Auth Routes
Auth::routes(['register' => false]);
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



//ADMIN
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'namespace' => '\App\Http\Controllers\Admin'], function(){
    Route::post('buscaProduto', ['as' => 'ajax.busca', 'uses' => 'VendaController@buscaProduto']);
    Route::resource('/vendas', 'VendaController', ['as' => 'admin']);
    Route::resource('/users', 'UserController', ['as' => 'admin']);
    Route::resource('/produtos', 'ProdutoController', ['as' => 'admin']);

    Route::get('artisan/{command}', '\App\Http\Controllers\Admin\ArtisanController@index');
});

//dd(Route::getRoutes());

Route::get('/', function (){
    return redirect('/admin/vendas');
})->name('home');
