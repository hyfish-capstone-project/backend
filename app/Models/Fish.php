<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;

    protected $table = 'fishes';
    protected $fillable = [
        'name',
        'description',
        'nutrition_image_url'
    ];

    public function captures()
    {
        return $this->hasMany(Capture::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function images()
    {
        return $this->hasMany(FishImage::class);
    }

}
