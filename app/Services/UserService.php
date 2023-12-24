<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function setUser($request){
        $data = $request->all();
        $user = User::findByTwitchId($data["id"]);
        if($user){

        }
        $response = [
            'twitch_id' => $data["id"],
            'token' => $data["token"],
            "test" => $data
        ];
        return response($response, 200);
    }

    public function login($request){
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
            return response($response, 200);
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
            return response($response, 200);
        }        
    }

    public function getData($token){
        $user = User::findByToken($token);
        if($user){
            $response = [
                'status' => "success",
                'data' => [
                    'avatar' => $user->avatar,
                    'user' => $user->name,
                    'id' => $user->id
                ]
            ];
            $response_code = 200;
        } 
        else {
            $response = [
                'status' => "error",
                'data' => "Brak użytkownika"
            ];
            $response_code = 400;
        }        
        return response($response, $response_code);        
    }

    public function findPatrons($token){
        $user = User::findByToken($token);
        if($user){
            $patrons = User::findPatrons($user->id);
            $response = [
                'status' => "success",
                'data' => $patrons
            ];
            $response_code = 200;
        } 
        else {
            $response = [
                'status' => "error",
                'data' => "Brak użytkownika"
            ];
            $response_code = 400;
        }        
        return response($response, $response_code);        
    }

    public function findPatronizes($token){
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
        return response($response, $response_code);
    }
}