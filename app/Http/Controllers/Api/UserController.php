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
                $user->avatar = $data["profile_image_url"];
            }
            if($user->name!=$data["login"]){
                $user->name = $data["login"];
            }
            if($user->email!=$data["email"]){
                $user->email = $data["email"];
            }
            if($user->token!=$data["token"]){
                $user->token = $data["token"];
            }
            $user->save();
            $response = [
                'exist' => "true",
                'token' => $data["token"]
            ];
            return response($response, 201);
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
            $response = [
                'exist' => "false",
                'token' => $data["token"]
            ];
            return response($response, 201);
        }
    }
    public function data($token)
    {
        $user = User::findByToken($token);
        if($user){
            $response = [
                'status' => "success",
                'data' => [
                    'avatar' => $user->avatar,
                    'user' => $user->name
                ]
            ];

        } 
        else {
            $response = [
                'status' => "error",
                'data' => "Brak użytkownika"
            ];
        }        
        return response($response, 201);
    }
    public function patrons($token)
    {
        $user = User::findByToken($token);
        if($user){
            $patrons = User::findPatrons($user->id);
            $response = [
                'status' => "success",
                'data' => $patrons
            ];
        } 
        else {
            $response = [
                'status' => "error",
                'data' => "Brak użytkownika"
            ];
        }        
        return response($response, 201);
    }
    public function patronizes($token)
    {
        $user = User::findByToken($token);
        if($user){
            $patronizes = User::findPatronizes($user->id);
            $response = [
                'status' => "success",
                'data' => $patronizes
            ];
        } 
        else {
            $response = [
                'status' => "error",
                'data' => "Brak użytkownika"
            ];
        }        
        return response($response, 201);
    }

}