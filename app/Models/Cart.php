<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'session',
        'user_id'
    ];

    /**
     * The attributes that should be appended to the model.
     *
     * @var array
     */
    protected $appends = [
        'quantity',
        'total',
    ];

    /**
     * Get the items in the cart.
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get the total quantity of items in the payment.
     *
     * @return int
     */
    public function getQuantityAttribute()
    {
        return $this->items()->sum('quantity');
    }

    /**
     * Get the total amount of the payment.
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->quantity * $item->product->price;
        }

        return $total;
    }
}
