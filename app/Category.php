<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug'        
    ];

    /**
     * Ligação de N:N (muitos para muitos) entre category e produtos
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
