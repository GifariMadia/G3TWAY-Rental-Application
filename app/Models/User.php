<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    public $timestamps = false;

    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'identity_card', 'password',
        'driving_license', 'name_bank', 'bank_number'
    ];

    protected $hidden = ['password'];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'user_id');
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class, 'user_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}
