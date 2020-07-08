<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /** exibe a tela do carrinho */
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('cart', compact('cart'));
    }

    /** Aciona ou cria a sessao do carrinho */
    public function add(Request $request)
    {
        $product = $request->get('product');

        /** Verifico se existe sessao para o produto */
        if (session()->has('cart')) {    
            
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug'); 

            if (in_array($product['slug'], $productsSlugs )) {
                
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                
                session()->put('cart', $products);
            
            } else {

                /** se existe adicina na sesao existente */
                session()->push('cart', $product);

            }
            
        }else{
            /** se não existir cria uma sesao com o produto */
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('Produto adicionado no carrinho!')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);

    }

    public function remove($slug)
    {
        if (!session()->has('cart')) 
            return redirect()->route('cart.index');

        $products = session()->get('cart');     
            
        $products = array_filter($products, function($line) use($slug){
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');

        flash('Desistência da Campra Realizada com Sucesso!')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function($line) use($slug, $amount) {
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }

            return $line;

        }, $products);

        return $products;
    }
}
