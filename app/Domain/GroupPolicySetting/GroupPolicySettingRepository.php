<?php

namespace App\Domain\GroupPolicySetting;

use App\Enums\RecordStatus;
use App\Models\GroupPolicySetting;
use Illuminate\Database\Eloquent\Collection;

class GroupPolicySettingRepository
{
    private GroupPolicySetting $groupPolicySetting;

    public function __construct(GroupPolicySetting $groupPolicySetting)
    {
        $this->groupPolicySetting = $groupPolicySetting;
    }

    public function getGroupPolicySettingByGroupIds(array $groupIds): Collection
    {
        return $this->groupPolicySetting->with(['group', 'policy'])
            ->where('pcm_group_uuid', $groupIds)
            ->where('record_status', RecordStatus::NORMAL)
            ->get();
    }
}
