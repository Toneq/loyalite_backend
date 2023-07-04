<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EmoteService;

class EmoteController extends Controller
{
    protected $emoteService;

    public function __construct(EmoteService $emoteService)
    {
        $this->emoteService = $emoteService;
    }
}
