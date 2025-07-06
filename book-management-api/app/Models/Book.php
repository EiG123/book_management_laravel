<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'title',
        'author',
        'published_year',
        'genre',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
