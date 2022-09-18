<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->get();
    }

    public function getByUsername(String $username)
    {
        return $this->user->where('username', $username)->get();
    }

    public function save(Array $data)
    {
        try {
            
            $user = new $this->user;

            $user->username = $data['username'];
            $user->password = Hash::make($data['password']);
            $user->save();

            return $user->fresh();

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
        
    }
}