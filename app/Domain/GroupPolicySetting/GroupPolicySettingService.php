<?php

namespace App\Domain\GroupPolicySetting;

use Illuminate\Database\Eloquent\Collection;

class GroupPolicySettingService
{
    private Collection $groupPolicySettings;
    private GroupPolicySettingRepository $groupPolicySettingRepository;

    public function __construct(GroupPolicySettingRepository $groupPolicySettingRepository)
    {
        $this->groupPolicySettings = new Collection;
        $this->groupPolicySettingRepository = $groupPolicySettingRepository;
    }

    public function getGroupPolicySettings(): Collection
    {
        return $this->groupPolicySettings;
    }

    public function getGroupPolicySettingByGroupIds(array $groupIds): self
    {
        $this->groupPolicySettings = $this->groupPolicySettingRepository->getGroupPolicySettingByGroupIds($groupIds);

        if ($this->groupPolicySettings->isEmpty()) {
            throw GroupPolicySettingException::groupPolicySettingNotFound();
        }

        return $this;
    }
}
