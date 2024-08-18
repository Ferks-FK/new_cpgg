<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
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
        'type',
        'price',
        'quantity',
        'active',
        'category_id',
    ];

    /**
     * Get the category of the product.
     */
    public function category()
    {
        return $this->belongsTo(StoreCategory::class);
    }

    /**
     * Get the payment item for the product.
     */
    public function paymentItem()
    {
        return $this->morphOne(PaymentItem::class, 'purchasable');
    }
}
