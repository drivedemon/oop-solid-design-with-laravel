<?php

namespace App\Domain\Document\UserGroupDocument;

use App\Enums\DocumentType\DocumentType;
use App\Enums\RecordStatus;
use App\Models\UserGroupDocument;
use Illuminate\Database\Eloquent\Collection;

class UserGroupDocumentRepository
{
    private UserGroupDocument $userGroupDocument;

    public function __construct(UserGroupDocument $userGroupDocument)
    {
        $this->userGroupDocument = $userGroupDocument;
    }

    public function getUserGroupDocumentByUserGroupIds(array $userGroupIds, DocumentType $documentType): Collection
    {
        return $this->userGroupDocument->with(['documentType', 'userGroup'])
            ->whereHas('documentType', function ($query) use ($documentType) {
                $query->where('type', $documentType);
            })
            ->where('record_status', RecordStatus::NORMAL)
            ->whereIn('pcm_user_group_uuid', $userGroupIds)
            ->orderBy('sequential')
            ->get();
    }
}
