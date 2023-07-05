<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\EmoteService;

class EmoteController extends Controller
{
    protected $emoteService;

    public function __construct(EmoteService $emoteService)
    {
        $this->emoteService = $emoteService;
    }

    public function get_user_emotes_and_icons($data){
        return $this->emoteService->getUserEmotesAndIcons($data);
    }

    public function get_user_emotes($data){
        return $this->emoteService->getUserEmotes($data);
    }

    public function get_user_icons($data){
        return $this->emoteService->getUserIcons($data);
    }
}
