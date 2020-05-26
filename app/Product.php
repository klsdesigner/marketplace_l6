<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{

    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'body', 'price', 'slug'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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
    
    /**
     * Ligação de 1:N onde um produto tem varias images
     */
    public function photos()
    {
        //ProductPhotos::class
        return $this->hasMany(ProductPhoto::class);
    }


}
