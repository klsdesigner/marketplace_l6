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
 
use App\Product;

//Rota para frontend
Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');


Route::get('/model', function () {       
    //$products = \App\Product::all(); // select * form products
    //return $products;
    /****************** 
    ** ACTIVE RECORD **
    *******************/
    //Gravar
    // $user =  new \App\User();
    // $user->name = "Kleber"; 
    // $user->email = "kls36@hotmail.com"; 
    // $user->password = bcrypt("123456"); 
    //Editar
    // $user =  new \App\User::find(1);
    // $user->name = "Kleber de Souza"; 
    // $user->save(); 
    // \App\User::all(); //retorna todos os dados
    // \App\User::find(3); //retorna um unico dado
    // equivale a um SELECT * FROM users WHERE name = 'Simone Cartwright'
    // \App\User::where('name', 'Simone Cartwright')->first(); // ou ->get()
    // \App\User::paginate(10); // retorno com paginação
    /*
    ********************************************* 
    *** MASS ASSIGNMENT - ATIBUIÇÃO EM MASSA ****
    *********************************************
    */
    /** Metodo create */
    // $user = \App\User::create([
    //     'name' => 'Kleber de Souza',
    //     'email' => 'kls36@hotmail.com',
    //     'password' => bcrypt('123456')
    // ]);     
    /** MASS UPDATE */
    // $user = \App\User::find(21);
    // $user->update([
    // 'name' => 'Kleber de Souza atualizado'
    // ]); // retorna true ou false 
    //return \App\User::all();
    /** Pegando uma store de um determinado Usuario */
    // $user = \App\User::find(5);
    //return $user->store;
    /** Pegar os produtos de uma loja */
    //$loja = \App\Store::find(1);
    //return $loja->products; // $loja->products()->where('id', 9)->get(); 
    /** 
     * ADICIONADO CATEGORIAS 
     */ 
    // \App\Category::create([
    //     'name' => 'Games',
    //     'description' => 'Categorias de games',
    //     'slug' => 'games'
    // ]);
    // \App\Category::create([
    //     'name' => 'Notebooks',
    //     'description' => 'Categoria de Notebooks',
    //     'slug' => 'notbooks'
    // ]);    
    /** 
     *Adicionar um produto para uma categoria ou vice-versa
     */
    //$produto = \App\Product::find(10);
    //adiciona um produto para uma categoria
    //dd($produto->categories()->attach([1]));
    //dd($produto->categories()->sync([2])); //Melhor opção...
    //remove um produto para uma categoria
    //dd($produto->categories()->detach([1])); 
    return \App\Category::all();      
});


 Route::group(['middleware' => ['auth']], function () {
    
    Route::prefix('/admin')->namespace('Admin')->name('admin.')->group(function(){

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
