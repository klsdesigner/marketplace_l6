<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /** Atributo pra produtct */
    private $product;

    /** Metodo para construtor da classe */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //busca todos os produtos e faz o retorno para a view com a paginação
        $products = $this->product->paginate(10);

        return view('admin.products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Busca e retorna para views todos os ids e nomes das lojas cadastradas
        $stores = \App\Store::all(['id', 'name']);

        return view('admin.products.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //Recebe os dados do formulario
        $data = $request->all();

        //$store = \App\Store::find($data['store']);
        $store = auth()->user()->store;
        $store->products()->create($data);

        flash('Produto Criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->findOrFail($product);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();

        $product = $this->product->find($product);
        $product->update($data);

        flash('Produto Atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {        
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto Removido com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }
}
