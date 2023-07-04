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
        return $this->userService->setUser($request);
    }

    public function login(Request $request)
    {
        return $this->userService->Login($request);
    }
    public function data($token)
    {
        return $this->userService->getData($token);
    }
    public function patrons($token)
    {
        return $this->userService->findPatrons($token);
    }
    public function patronizes($token)
    {
        return $this->userService->findPatronizes($token);
    }

}