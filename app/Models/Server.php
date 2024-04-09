<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
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
        'external_id',
        'identifier',
        'suspended',
        'pterodactyl_id',
        'product_id',
        'user_id',
    ];

    /**
     * Get the user that owns the server.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that owns the server.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
