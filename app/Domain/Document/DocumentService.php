<?php

namespace App\Domain\Document;

use App\Domain\Document\Adapters\ServiceInterface;
use App\Enums\DocumentType\DocumentType;
use Illuminate\Database\Eloquent\Collection;

class DocumentService
{
    private DocumentType $documentType;
    private ServiceInterface $groupPolicyDocumentService;
    private ServiceInterface $userDocumentService;
    private ServiceInterface $userGroupDocumentService;

    public function __construct(
        ServiceInterface $groupPolicyDocumentService,
        ServiceInterface $userDocumentService,
        ServiceInterface $userGroupDocumentService
    ) {
        $this->groupPolicyDocumentService = $groupPolicyDocumentService;
        $this->userDocumentService = $userDocumentService;
        $this->userGroupDocumentService = $userGroupDocumentService;
    }

    public function setDocumentType(DocumentType $documentType): void
    {
        $this->documentType = $documentType;
    }

    public function getGroupPolicyDocuments(): Collection
    {
        return $this->groupPolicyDocumentService->getDocuments();
    }

    public function getUserDocuments(): Collection
    {
        return $this->userDocumentService->getDocuments();
    }

    public function getUserGroupDocuments(): Collection
    {
        return $this->userGroupDocumentService->getDocuments();
    }

    public function getGroupPolicyDocumentByGroupPolicySettingIds(array $groupPolicySettingIds): void
    {
        $this->groupPolicyDocumentService->getDocumentByIds($groupPolicySettingIds, $this->documentType);
    }

    public function getUserDocumentByUserId(string $userId): void
    {
        $this->userDocumentService->getDocumentByIds([$userId], $this->documentType);
    }

    public function getUserGroupDocumentByUserGroupIds(array $userGroupIds): void
    {
        $this->userGroupDocumentService->getDocumentByIds($userGroupIds, $this->documentType);
    }
}
