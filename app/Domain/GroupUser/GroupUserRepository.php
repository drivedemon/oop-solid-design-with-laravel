<?php

namespace App\Domain\GroupUser;

use App\Models\GroupUser;

class GroupUserRepository
{
    private GroupUser $groupUser;

    public function __construct(GroupUser $groupUser)
    {
        $this->groupUser = $groupUser;
    }

    public function findOrFail(string $uuid): GroupUser
    {
        return $this->groupUser->findOrFail($uuid);
    }
}
