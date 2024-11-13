<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Conner\Likeable\Likeable;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;


class Post extends Model
{
    use HasFactory, Likeable, HasTrixRichText;

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
