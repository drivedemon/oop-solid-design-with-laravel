<?php

namespace App\Domain\UserGroup;

use App\Enums\RecordStatus;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Collection;

class UserGroupRepository
{
    private UserGroup $userGroup;

    public function __construct(UserGroup $userGroup)
    {
        $this->userGroup = $userGroup;
    }

    public function getUserGroupByUserId(string $userId): Collection
    {
        return $this->userGroup->with([
            'group',
            'groupUsers' => function ($query) use ($userId) {
                $query->with(['user'])->where('pcm_user_uuid', $userId);
            },
        ])
            ->whereHas('groupUsers', function ($query) use ($userId) {
                $query->where('pcm_user_uuid', $userId);
            })
            ->where('record_status', RecordStatus::NORMAL)
            ->get();
    }
}
