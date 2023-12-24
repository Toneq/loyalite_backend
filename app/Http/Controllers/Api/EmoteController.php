<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\EmoteService;
use Illuminate\Http\Request;

class EmoteController extends Controller
{
    protected $emoteService;

    public function __construct(EmoteService $emoteService)
    {
        $this->emoteService = $emoteService;
    }

    public function get_user_emotes_and_icons($token){
        return $this->emoteService->getUserEmotesAndIcons($token);
    }

    public function get_user_emotes($data){
        return $this->emoteService->getUserEmotes($data);
    }

    public function get_user_icons($data){
        return $this->emoteService->getUserIcons($data);
    }

    public function send_user_icons(Request $request){
        return $this->emoteService->newIcon($request);
    }
}
