<?php

namespace App\Domain\Document\Adapters;

use App\Domain\Document\UserGroupDocument\UserGroupDocumentRepository;
use App\Enums\DocumentType\DocumentType;
use Illuminate\Database\Eloquent\Collection;

class UserGroupDocumentService implements ServiceInterface
{
    private Collection $userGroupDocuments;
    private UserGroupDocumentRepository $userGroupDocumentRepository;

    public function __construct(UserGroupDocumentRepository $userGroupDocumentRepository)
    {
        $this->userGroupDocuments = new Collection;
        $this->userGroupDocumentRepository = $userGroupDocumentRepository;
    }

    public function getDocuments(): Collection
    {
        return $this->userGroupDocuments;
    }

    public function getDocumentByIds(array $ids, DocumentType $documentType): self
    {
        $this->userGroupDocuments = $this->userGroupDocumentRepository->getUserGroupDocumentByUserGroupIds(
            $ids,
            $documentType
        );

        return $this;
    }
}
