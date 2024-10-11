<?php

namespace App\Domain\Group;

use App\Models\Group;

class GroupRepository
{
    private Group $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function findOrFail(string $uuid): Group
    {
        return $this->group->findOrFail($uuid);
    }
}
