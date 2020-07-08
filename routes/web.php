<?php

// use Illuminate\Http\Request;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\CheckoutController;
// use App\Product;

//Rota para frontend
Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

/** Carrinho de compras */
Route::prefix('cart')->name('cart.')->group(function () {

    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');

});

/** Rotas para pagamento */
Route::prefix('checkout')->name('checkout.')->group(function () {

    Route::get('/', 'CheckoutController@index')->name('index');

});


/** 
 * Rotas do admin protegidas por senha 
 * 
 * */
Route::group(['middleware' => ['auth']], function () {

    Route::prefix('/admin')->namespace('Admin')->name('admin.')->group(function () {

        /** 
         * ROTAS PARA STORES 
         */
        /**Route::prefix('stores')->name('stores.')->group(function(){
            Route::get('/', 'StoreController@index')->name('index');
            Route::get('/create', 'StoreController@create')->name('create');
            Route::post('/store', 'StoreController@store')->name('store');
            Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
            Route::post('/update/{store}', 'StoreController@update')->name('updade');
            Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        }); */
        Route::resource('stores', 'StoreController');
        /** ROTAS PARA PRODUTOS USANDO CONTROLLER COMO RECURSO */
        Route::resource('products', 'ProductController');
        /** ROTAS PARA CATEGORIAS USANDO CONTROLLER COMO RECURSO */
        Route::resource('categories', 'CategoryController');

        /** ROTA PARA REMOÇÃO DE IMAGENS DOS PRODUTOS */
        Route::post('photo/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
    });
});

Auth::routes();

 //Route::get('/home', 'HomeController@index')->name('home');
