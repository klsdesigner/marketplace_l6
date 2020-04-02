<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caterory extends Model
{
    //

    /**
     * Ligação de N:N (muitos para muitos) entre category e produtos
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
