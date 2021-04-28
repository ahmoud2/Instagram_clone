<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $table = 'profile_user';
    protected $guarded = [];

    public static function isFollow($user_id,$profile_id)
    {
        return Follow::where('user_id',$user_id)
                        ->where('profile_id',$profile_id)->count();
    }
}
