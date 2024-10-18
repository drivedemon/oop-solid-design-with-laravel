<?php

namespace App\Domain\UserGroup;

use App\Domain\Group\GroupException;
use Illuminate\Database\Eloquent\Collection;

class UserGroupService
{
    private Collection $userGroups;
    private UserGroupRepository $userGroupRepository;

    public function __construct(UserGroupRepository $userGroupRepository)
    {
        $this->userGroups = new Collection;
        $this->userGroupRepository = $userGroupRepository;
    }

    public function getUserGroups(): Collection
    {
        return $this->userGroups;
    }

    public function getUserGroupByUserId(string $userId): self
    {
        $this->userGroups = $this->userGroupRepository->getUserGroupByUserId($userId);

        if ($this->userGroups->isEmpty()) {
            throw UserGroupException::userGroupNotFound();
        }

        if ($this->userGroups->pluck('group')->filter()->isEmpty()) {
            throw GroupException::groupNotFound();
        }

        return $this;
    }
}
