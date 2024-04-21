<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'memory',
        'cpu',
        'swap',
        'disk',
        'io',
        'databases',
        'backups',
        'allocations',
        'minimum_credits',
        'active',
        'eggs',
        'nodes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected function casts()
    {
        return [
            'eggs' => 'array',
            'nodes' => 'array',
        ];
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function (Product $product) {
            $product->slug = Str::random();
        });
    }

    /**
     * Get the product's servers.
     */
    public function servers()
    {
        return $this->hasMany(Server::class);
    }
}
