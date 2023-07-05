<?php

namespace App\Services;

use App\Models\Emote;
use App\Models\User;

class EmoteService
{
    public function getUserEmotesAndIcons($request){
        $data = $request->all();

        $user = User::where('token', $data["token"])->get();

        if(!$user){
            $response = [
                'message' => "Brak użytkownika"
            ];
            return response($response, 404);           
        }

        $icons = Emote::where('channel_id', $user->id)->get()
                    ->where('type', 'icon');
        $emotes = Emote::where('channel_id', $user->id)->get()
                    ->where('type', 'emote');

        $response = [
            'icons' => $icons,
            'emotes' => $emotes
        ];
        return response($response, 201);
    }

    public function getUserEmotes($data){
        $user = User::where('token', $data->token)->get();

        if(!$user){
            $response = [
                'message' => "Brak użytkownika"
            ];
            return response($response, 404);           
        }

        $emotes = Emote::where('channel_id', $user->id)->get()
                    ->where('type', 'emote');

        $response = [
            'emotes' => $emotes
        ];
        return response($response, 201);
    }

    public function getUserIcons($data){
        $user = User::where('token', $data->token)->get();

        if(!$user){
            $response = [
                'message' => "Brak użytkownika"
            ];
            return response($response, 404);           
        }

        $icons = Emote::where('channel_id', $user->id)->get()
                    ->where('type', 'icon');

        $response = [
            'icons' => $icons
        ];
        return response($response, 201);
    }
}