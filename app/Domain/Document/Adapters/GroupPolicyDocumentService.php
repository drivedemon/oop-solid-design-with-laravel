<?php

namespace App\Domain\Document\Adapters;

use App\Domain\Document\GroupPolicyDocument\GroupPolicyDocumentRepository;
use App\Enums\DocumentType\DocumentType;
use Illuminate\Database\Eloquent\Collection;

class GroupPolicyDocumentService implements ServiceInterface
{
    private Collection $groupPolicyDocuments;
    private GroupPolicyDocumentRepository $groupPolicyDocumentRepository;

    public function __construct(GroupPolicyDocumentRepository $groupPolicyDocumentRepository)
    {
        $this->groupPolicyDocuments = new Collection;
        $this->groupPolicyDocumentRepository = $groupPolicyDocumentRepository;
    }

    public function getDocuments(): Collection
    {
        return $this->groupPolicyDocuments;
    }

    public function getDocumentByIds(array $ids, DocumentType $documentType): self
    {
        $this->groupPolicyDocuments = $this->groupPolicyDocumentRepository->getGroupPolicyDocumentByGroupPolicySettingIds(
            $ids,
            $documentType
        );

        return $this;
    }
}
