<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store ($profile_id){
        $user_id = Auth()->user()->id;


        $isFollow = Follow::isFollow($user_id,$profile_id);

        switch ($isFollow){
            case 0:
                Follow::create([
                        'user_id' => $user_id,
                        'profile_id' => $profile_id,
                    ]);
                return json_encode(['follow'=> 1]);
                break;
            case 1:
                Follow::where('user_id',$user_id)
                        ->where('profile_id',$profile_id)
                        ->delete();
                return json_encode(['follow'=> 0]);
                break;
            default:
                break;
        }

    }
}
