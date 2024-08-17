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

    public function items()
    {
        return $this->belongsTo(PaymentItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
