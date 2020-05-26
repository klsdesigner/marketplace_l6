<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Product;
use App\Traits\UploadTrait;

class ProductController extends Controller
{

    /** Usa da Uploadtrait */
    use UploadTrait;

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
        //$products = $this->product->paginate(10);

        //Busca a loja do uruario authenticado
        $userStore = auth()->user()->store;

        // Busca todos os produtos da loja do usuario authenticado
        $products = $userStore->products()->paginate(10);

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
        //$stores = \App\Store::all(['id', 'name']);

        //Busca todas a categorias 
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
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

        //Se não existir categorias passa nulo
        $categories =  $request->get('categories', null);

        //$store = \App\Store::find($data['store']);
        $store = auth()->user()->store;
        $product = $store->products()->create($data);

        //Ligação N:N no banco
        $product->categories()->sync($categories);

        //Verifico se exite images para upload
        if ($request->hasFile('photos')) {
            
            $images = $this->imageUpload($request->file('photos'), 'image');

            //Faz a inserção das images/referencias no banco
            $product->photos()->createMany($images); 

        }

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
        //Busca todas a categorias 
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
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

        //Se não existir categorias passa nulo
        $categories =  $request->get('categories', null);

        $product = $this->product->find($product);
        $product->update($data);

        if (!is_null($categories))                   
            //Ligação N:N no banco
            $product->categories()->sync($categories);
        

        //Verifico se exite images para upload
        if ($request->hasFile('photos')) {
            
            $images = $this->imageUpload($request->file('photos'), 'image');

            //Faz a inserção das images/referencias no banco
            $product->photos()->createMany($images); 

        }

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
