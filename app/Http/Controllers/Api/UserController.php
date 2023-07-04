<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        return $this->userService->store($request);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }
    public function data($token)
    {
        return $this->userService->data($token);
    }
    public function patrons($token)
    {
        return $this->userService->patrons($token);
    }
    public function patronizes($token)
    {
        return $this->userService->patronizes($token);
    }

}