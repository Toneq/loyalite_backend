<?php

namespace App\Services;

use App\Models\Emote;
use App\Models\User;

class EmoteService
{
    public function getUserEmotesAndIcons($token){
        $user = User::where('twitch_id', $token)
            ->orWhere('token', $token)
            ->orWhere('name', $token)
            ->first();

        if(!$user){
            $response = [
                'message' => "Brak użytkownika"
            ];
            return response($response, 400);           
        }

        $icons = Emote::where('channel_id', $user->id)
            ->where('type', 'icon')
            ->get();

        $emotes = Emote::where('channel_id', $user->id)
            ->where('type', 'emote')
            ->get();

        $response = [
            'icons' => $icons,
            'emotes' => $emotes
        ];

        return response()->json($response, 200);
    }

    public function getUserEmotes($data){
        $user = User::where('token', $data->token)
            ->orWhere('name', $data->token)
            ->orWhere('channel_id', $data->token)
            ->first();

        if(!$user){
            $response = [
                'message' => "Brak użytkownika"
            ];
            return response($response, 400);           
        }

        $emotes = Emote::where('channel_id', $user->id)->get()
                    ->where('type', 'emote');

        $response = [
            'emotes' => $emotes
        ];
        return response($response, 200);
    }

    public function getUserIcons($data){
        $user = User::where('token', $data->token)
            ->orWhere('name', $data->token)
            ->orWhere('channel_id', $data->token)
            ->first();

        if(!$user){
            $response = [
                'message' => "Brak użytkownika"
            ];
            return response($response, 400);           
        }

        $icons = Emote::where('channel_id', $user->id)->get()
                    ->where('type', 'icon');

        $response = [
            'icons' => $icons
        ];
        return response($response, 200);
    }
}