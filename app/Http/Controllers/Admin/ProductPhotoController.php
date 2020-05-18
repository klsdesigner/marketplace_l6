<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    /**
     * Metodo para remoção de fotos do produto 
     *
     * @param Request $request
     * @return void
     */
    public function removePhoto(Request $request)
    {
        $photoName = $request->get('photoName');

        //Remove a imagem da pasta
        if (Storage::disk('public')->exists('$photoName')) {
            Storage::disk('public')->delete('$photoName');
        }

        //Remove a imagem do banco
        $removePhoto = ProductPhoto::where('image', $photoName);
        $productId = $removePhoto->first()->product_id;

        $removePhoto->delete();

        flash('Imagem removida com sucesso!!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);

    }
}
