<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    // filable
    protected $fillable = ['image'];

    //Ligação de 1:N onde imagens pertense a um produto
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
