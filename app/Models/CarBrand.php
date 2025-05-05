<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarBrand extends Model
{
    public $timestamps = false;


    use HasFactory;

    protected $primaryKey = 'brand_id';

    protected $fillable = ['brand_name'];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class, 'brand_id');
    }
}
