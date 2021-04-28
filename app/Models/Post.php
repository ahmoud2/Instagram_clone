<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'caption',
        'image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Returning post comments.
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
