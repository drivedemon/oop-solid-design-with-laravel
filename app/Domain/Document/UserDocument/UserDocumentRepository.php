<?php

namespace App\Domain\Document\UserDocument;

use App\Enums\DocumentType\DocumentType;
use App\Enums\RecordStatus;
use App\Models\UserDocument;
use Illuminate\Database\Eloquent\Collection;

class UserDocumentRepository
{
    private UserDocument $userDocument;

    public function __construct(UserDocument $userDocument)
    {
        $this->userDocument = $userDocument;
    }

    public function getUserDocumentByUserIds(array $userIds, DocumentType $documentType): Collection
    {
        return $this->userDocument->with(['documentType', 'user'])
            ->whereHas('documentType', function ($query) use ($documentType) {
                $query->where('type', $documentType);
            })
            ->where('record_status', RecordStatus::NORMAL)
            ->whereIn('pcm_user_uuid', $userIds)
            ->orderBy('sequential')
            ->get();
    }
}
