<?php

namespace Document;

use App\Domain\Document\Adapters\UserGroupDocumentService;
use App\Domain\Document\UserGroupDocument\UserGroupDocumentRepository;
use App\Enums\DocumentType\DocumentType as EDocumentType;
use App\Models\DocumentType;
use App\Models\GroupPolicyDocument;
use App\Models\GroupPolicySetting;
use App\Models\UserGroup;
use App\Models\UserGroupDocument;
use Tests\TestCase;

class UserGroupDocumentServiceTest extends TestCase
{
    protected function getService($repository)
    {
        return new UserGroupDocumentService($repository);
    }

    protected function getRepository()
    {
        return $this->createMock(UserGroupDocumentRepository::class);
    }

    public function test_get_user_group_document_by_user_group_ids(): void
    {
        $documentType = DocumentType::factory()->create(['type' => EDocumentType::POLICY_DOCUMENT]);
        $userGroup = UserGroup::factory()->create();
        $groupPolicyDocuments = UserGroupDocument::factory()->count(5)->create([
            'pcm_user_group_uuid' => $userGroup->uuid,
            'pcm_document_type_uuid' => $documentType->uuid,
        ]);

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getUserGroupDocumentByUserGroupIds')
            ->willReturn($groupPolicyDocuments);

        $service = $this->getService($repository);

        $this->assertEmpty($service->getDocuments());

        $service->getDocumentByIds([$userGroup->uuid], $documentType->type);

        $this->assertNotEmpty($service->getDocuments());
        $this->assertCount(5, $service->getDocuments());
    }
}
