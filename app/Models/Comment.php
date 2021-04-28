<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // Returning comment's user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
