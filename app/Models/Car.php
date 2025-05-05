<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    public $timestamps = false;


    use HasFactory;

    protected $primaryKey = 'car_id';

    protected $fillable = [
        'user_id', 'brand_id', 'type_id', 'price_per_day', 'status',
        'specifications', 'stnk'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class, 'brand_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(CarType::class, 'type_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(CarPhoto::class, 'car_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'car_id');
    }
}
