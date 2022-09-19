<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseAPI;

class AuthController extends Controller
{
    use ResponseAPI;
    
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $data = $request->only([
            'username',
            'password'
        ]);

        try {
            $result = $this->userService->createNewUser($data);

            return $this->success("Berhasil register", ["username" => $data['username']]);

        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }

    }

    public function login(Request $request)
    {
        $data = $request->only([
            'username',
            'password'
        ]);

        try {

            $result = $this->userService->login($data);

            return $this->success("Berhasil login", $result);

        } catch (\Exception $error) {
            
            return $this->error($error->getMessage(), $error->getCode());

        }

    }

    public function logout(Request $request)
    {
        $result = $this->userService->logout();
        return $this->success("Berhasil logout", []);
    }
}
