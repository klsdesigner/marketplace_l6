<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    use UploadTrait;

    //Costrutor para Middleware user.has.store
    public function __construct()
    {
        /** 
         * Controla a verificação para existencia de loja para usuarios se não existira continua.
         * only() ou except() 
         */
        $this->middleware('user.has.store')->only(['create', 'store']); 
    }

    //Pagina pricipal com listagem de todas as lojas
    public function index()
    {
        //$stores = \App\Store::all(); // listagem total sem paginação
        //$stores = \App\Store::paginate(10); //listagem com paginação

        $store = auth()->user()->store;

        return  view('admin.stores.index', compact('store'));
    }

    /** Metodo para Chamada do formulario de cadastro para lojas */
    public function create()
    {
        
        //busca todos os id e nomes dos usuários
        $users = \App\User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    /**Metodo para Receber e cria uma nova Loja */
    public function store(StoreRequest $request)
    {
        //Recebe os dados do formulario
        $data = $request->all();

        //busca o usuario de acordo com o usuario do request
        //$user = \App\User::find($data['user']);

        //Pego o usuario autenticado
        $user = auth()->user();
   
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        } 

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
    public function update(StoreRequest $request, $store)
    {
        $data = $request->all();

        $store = \App\Store::find($store);

        if ($request->hasFile('logo')) { 

            if (Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

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
