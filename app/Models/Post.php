<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liked_posts()
    {
        return $this->belongsToMany(User::class, 'liked_posts');
    }

    public function followed_posts()
    {
        return $this->belongsToMany(User::class, 'followed_posts');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
