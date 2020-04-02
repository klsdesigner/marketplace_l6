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
 //use Illuminate\Routing\Route;
 

Route::get('/', function () {
    return view('welcome');
});

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
    //Metodo create
    // $user = \App\User::create([
    //     'name' => 'Kleber de Souza',
    //     'email' => 'kls36@hotmail.com',
    //     'password' => bcrypt('123456')
    // ]); 
    
    //MASS UPDATE
    // $user = \App\User::find(21);
    // $user->update([
    //     'name' => 'Kleber de Souza atualizado'
    // ]); // retorna true ou false 


    return \App\User::all();
});