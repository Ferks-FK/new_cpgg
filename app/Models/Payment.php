<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'currency',
        'gateway_type',
        'status',
        'transaction_id',
        'user_id',
    ];

    /**
     * Get the items in the payment.
     */
    public function items()
    {
        return $this->hasMany(PaymentItem::class);
    }

    /**
     * Get user related of payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function deliver()
    {
        $this->update(['status' => 'completed']);

        foreach ($this->items as $item) {
            $item->purchasable->type === 'credits'
                ? $this->user->increment('credits', $item->purchasable->quantity)
                : $this->user->increment('server_limit', $item->purchasable->quantity);
        }
    }
}
