<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarType extends Model
{
    public $timestamps = false;


    use HasFactory;

    protected $primaryKey = 'type_id';

    protected $fillable = ['type_name'];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'type_id');
    }
}
