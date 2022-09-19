<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Repositories\User\UserRepository;

class UserService
{

    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    protected function createNewToken($token){
        return [
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ];
    }

    public function logout()
    {
        auth()->logout();
        return true;
    }

    public function login(Array $data)
    {
        try {
            $validator = Validator::make($data, [
                'username' => 'required',
                'password' => 'required',
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }
    
            $user = $this->userRepository->getByUsername($data['username']);
    
    
            if (! $token = auth()->attempt($validator->validated($user))) {
                throw new \Exception("Unauthorized", 401);
            }
    
            return $this->createNewToken($token);
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), $error->getCode());
        }
        
    }

    public function createNewUser(Array $data)
    {
        

        try {

            $validator = Validator::make($data, [
                'username' => 'required|unique:users',
                'password' => 'required'
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }

            $result = $this->userRepository->save($data);
            
            return $result;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), $error->getCode());
        }

    }
}