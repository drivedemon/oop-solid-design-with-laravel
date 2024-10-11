<?php

namespace App\Domain\User;

use App\Models\User;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateById(string $uuid, UserDTO $dto): User
    {
        return $this->userRepository->updateById($uuid, $dto);
    }
}
