<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';
    protected $fillable = [
        'name',
        'fish_id'
    ];

    public function fish()
    {
        return $this->belongsTo(Fish::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredient')->withPivot('amount', 'measurement');
    }
}
