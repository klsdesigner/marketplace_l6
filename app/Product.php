<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Ligação de 1:N (um pra muitos entre produtos e loja)
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Ligação de N:N (muitos para muitos) entre produtos e category
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    
}
