<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingridient extends Model
{
    use HasFactory;

    protected $table = 'ingridients';
    protected $fillable = [
        'name'
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingridient');
    }
}
