<?php

namespace App\Domain\Document\GroupPolicyDocument;

use App\Enums\DocumentType\DocumentType;
use App\Enums\RecordStatus;
use App\Models\GroupPolicyDocument;
use Illuminate\Database\Eloquent\Collection;

class GroupPolicyDocumentRepository
{
    private GroupPolicyDocument $groupPolicyDocument;

    public function __construct(GroupPolicyDocument $groupPolicyDocument)
    {
        $this->groupPolicyDocument = $groupPolicyDocument;
    }

    public function getGroupPolicyDocumentByGroupPolicySettingIds(array $groupPolicySettingIds, DocumentType $documentType): Collection
    {
        return $this->groupPolicyDocument->with(['documentType', 'groupPolicySetting'])
            ->whereHas('documentType', function ($query) use ($documentType) {
                $query->where('type', $documentType);
            })
            ->where('record_status', RecordStatus::NORMAL)
            ->whereIn('pcm_group_policy_setting_uuid', $groupPolicySettingIds)
            ->orderBy('sequential')
            ->get();
    }
}
