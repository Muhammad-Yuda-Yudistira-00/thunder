<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Conner\Likeable\Likeable;


class Post extends Model
{
    use HasFactory, Likeable;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }
}
