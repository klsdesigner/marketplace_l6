<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    //Pagina pricipal com listagem de todas as lojas
    public function index()
    {
        //$stores = \App\Store::all(); // listagem total sem paginação
        $stores = \App\Store::paginate(10); //listagem com paginação
        return  view('admin.stores.index', compact('stores'));
    }

    /** Metodo para Chamada do formulario de cadastro para lojas */
    public function create()
    {
        //busca todos os id e nomes dos usuários
        $users = \App\User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    /**Metodo para Receber e cria uma nova Loja */
    public function store(Request $request)
    {
        //Recebe os dados do formulario
        $data = $request->all();

        //busca o usuario de acordo com o usuario do request
        $user = \App\User::find($data['user']);

        //Cria a loja de acordo com o usuario
        $store = $user->store()->create($data);

        //mensagem de Sucesso e redirecionamento
        flash('Loja Criada com sucesso!')->success();
        return redirect()->route('admin.stores.index');

    }

    /** Metodo para chamada do formulario de edição */
    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }


    /** Metodo para realização da edição */
    public function update(Request $request, $store)
    {
        $data = $request->all();

        $store = \App\Store::find($store);
        $store->update($data);
        
        //mensagem de Sucesso e redirecionamento
        flash('Loja Atualizada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();

        //mensagem de Sucesso e redirecionamento
        flash('Loja Removida com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

}
