<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
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
        'active',
    ];

    /**
     * Get the store product that owns the category.
     */
    public function products()
    {
        return $this->hasMany(StoreProduct::class, 'category_id');
    }

    public function scopeActiveWithHasRelation($query, $relation)
    {
        return $query->where('active', true)->whereHas($relation);
    }
}
