<?php

namespace App\Domain\User;

use App\Enums\RecordStatus;
use App\Models\User;

class UserRepository
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findOrFail(string $uuid): User
    {
        return $this->user
            ->where('uuid', $uuid)
            ->where('record_status', RecordStatus::NORMAL)
            ->firstOrFail();
    }

    public function updateById(string $uuid, UserDTO $dto): User
    {
        $user = $this->findOrFail($uuid);
        $user->update($dto->toArray());

        return $user;
    }
}
