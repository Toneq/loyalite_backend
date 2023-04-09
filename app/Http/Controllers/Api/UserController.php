<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //xx
        $data = $request->all();
        $user = User::findByTwitchId($data["id"]);
        if($user){

        }
        $response = [
            'twitch_id' => $data["id"],
            'token' => $data["token"],
            "test" => $data
        ];
        return response($response, 201);
    }

    public function show(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $user = User::findByTwitchId($data["id"]);
        if($user){
            if($user->avatar!=$data["profile_image_url"]){
                $user->update(['avatar' => $data["profile_image_url"]]);
            }
            if($user->name!=$data["login"]){
                $user->update(['name' => $data["login"]]);
            }
            if($user->email!=$data["email"]){
                $user->update(['email' => $data["email"]]);
            }
            if($user->token!=$data["token"]){
                $user->update(['token' => $data["token"]]);
            }
        } else {
            $user = new User;
            $user->twitch_id = $data["id"];
            $user->avatar = $data["profile_image_url"];
            $user->name = $data["login"];
            $user->email = $data["email"];
            $user->token = $data["token"];
            if(strlen($data["login"]>=5)){
                $user->prefix = substr($data["login"], 0, 5);
            } else {
                $user->prefix = $data["login"];
            }
            $user->save();
        }
        $response = [
            'token' => $data["token"]
        ];
        return response($response, 201);
    }
}