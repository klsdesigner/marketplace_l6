<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{

    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'
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
