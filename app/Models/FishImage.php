<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishImage extends Model
{
    use HasFactory;

    protected $table = 'fish_images';
    protected $fillable = [
        'image_url',
        'fish_id'
    ];

    public function fish()
    {
        return $this->belongsTo(Fish::class);
    }
}
