<?php


declare(strict_types=1);

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getAll();

    public function getByUsername(String $id);

    public function save(Array $data);

}
