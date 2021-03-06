<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // create an empty profile after creating a new user.
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function($user){
            $user->profile()->create([
                'image' => 'storage/app-images/avatar.jpg',
                'description'=> 'Add a description !',
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }
}
