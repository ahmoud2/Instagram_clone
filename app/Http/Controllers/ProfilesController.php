<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['show']]);
    }

    public function index()
    {

        return "Index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $follows = (Auth()->user()) ? (Auth()->user()->following->contains($user->id)) : false;
        return view('profiles.profile',['user'=>$user,'follows'=>$follows]);
    }

    public function edit($username)
    {
        $user = User::where('username',$username)->firstOrfail();
        // Authorization using policies.
        $this->authorize('update', $user->profile);
        return view('profiles.edit',['user'=>$user]);
        return abort(403, 'Unauthorized action.');
    }

    public function update(Request $request, $username)
    {

            // extra Layer of protection.
            $unique ='';
            $validateImage = '';

            $user = User::where('username', $username)->firstOrfail();

            // Authorization using policy
            $this->authorize('update',$user->profile);

            if(isset($request->image)){
                $validateImage = 'image';
            }
            if ($request->username != $user->username){
                $unique ='unique:users';
            }
            $request->validate([
                'name'=>'required|string',
                'username'=>['required','string',$unique],
                'image'=> [$validateImage],
                'description'=>'required|string',
                'link'=>'url',
            ]);
            // Image resizing
            // The image path will return the path of the photo.
            if(isset($request->image)){
                $oldImage = $user->profile->image;
                $image_path =  'storage/'.$request->image->store('uploads/profiles_photo','public');
                Image::make($image_path)->fit(1000,1000)->save();

                $user->profile()->update([
                    'image'=> $image_path,
                    'description' => $request->description,
                    'link' => $request->link,
                ]);
                $user->update([
                    'name' => $request->name,
                    'username' => $request->username,
                ]);
                // deleting the image.
                unlink($oldImage);
            }else{
                $user->profile()->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'link' => $request->link,
                ]);
                $user->update([
                    'username' => $request->username,
                ]);
            }
            return redirect("/profiles/{$user->username}");



            return abort(403, 'Unauthorized action.');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
