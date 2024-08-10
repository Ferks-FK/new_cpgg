<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Traits\Extensiable;

class Gateway extends Model
{
    use HasFactory, Extensiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'name',
        'type',
        'data',
        'active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected function casts()
    {
        return [
            'data' => 'object',
            'active' => 'boolean'
        ];
    }

    /**
     * Get the image URL attribute.
     *
     * @param string $image
     * @return string|null
     */
    public function getImageAttribute($image)
    {
        return $image ? Storage::url('gateways/' . $image) : null;
    }
}
