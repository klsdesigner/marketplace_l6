<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * Ligação 1:1 com User (uma loja pertence a user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Ligação de 1:N (um pra muitos entre loja e produtos)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
