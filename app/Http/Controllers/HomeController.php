<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{

    /** Atributo pra produtct */
    private $product;

    /** Metodo para construtor da classe */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    /** Listagem da tela principal */
    public function index()
    {
        //Busca dos produtos
        $products = $this->product->limit(9)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('products'));
    }

    /** Pagina single */
    public function single($slug)
    {
        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product')); 
    }
}
