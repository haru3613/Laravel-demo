<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content'
    ];

    /**
     * Get the user model
     */
    public function user()
    {
        return $this->morphTo();
    }
}
