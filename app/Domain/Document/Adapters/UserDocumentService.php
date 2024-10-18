<?php

namespace App\Domain\Document\Adapters;

use App\Domain\Document\UserDocument\UserDocumentRepository;
use App\Enums\DocumentType\DocumentType;
use Illuminate\Database\Eloquent\Collection;

class UserDocumentService implements ServiceInterface
{
    private Collection $userDocuments;
    private UserDocumentRepository $userDocumentRepository;

    public function __construct(UserDocumentRepository $userDocumentRepository)
    {
        $this->userDocuments = new Collection;
        $this->userDocumentRepository = $userDocumentRepository;
    }

    public function getDocuments(): Collection
    {
        return $this->userDocuments;
    }

    public function getDocumentByIds(array $ids, DocumentType $documentType): self
    {
        $this->userDocuments = $this->userDocumentRepository->getUserDocumentByUserIds($ids, $documentType);

        return $this;
    }
}
