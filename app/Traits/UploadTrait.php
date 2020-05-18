<?php

namespace App\Traits;

trait UploadTrait {
    
    /**
     * imageUpload - realiza upload de imagem para o produto
     *
     * @param  mixed $request
     * @return void
     */
    private function imageUpload($images, $imageColumn = null)
    {
       
        //inicio um array vazio
        $uploadedImages = [];

        if (is_array($images)) {
            
            foreach ($images as $image) {                
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')]; 
            }

        } else {

            $uploadedImages = $images->store('logo', 'public');

        }

        return $uploadedImages;
    }

}
