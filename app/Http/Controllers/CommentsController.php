<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->Middleware('auth');
    }

    public function store(Request $request,$post_id)
    {
        $user_id  = Auth()->user()->id;

        $request->validate([
            'comment' => 'string|max:255'
        ]);

        
        return Comment::create([
            'post_id'=>$post_id,
            'user_id'=>$user_id,
            'comment'=>$request->comment,
        ]);

    }
}
