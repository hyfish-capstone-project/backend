<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    use HasFactory;

    protected $table = 'captures';
    protected $fillable = [
        'type',
        'freshness',
        'image_url',
        'score',
        'user_id',
        'fish_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fish()
    {
        return $this->belongsTo(Fish::class);
    }
}
