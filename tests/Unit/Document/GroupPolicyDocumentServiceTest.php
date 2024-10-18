<?php

namespace Tests\Unit\Document;

use App\Domain\Document\Adapters\GroupPolicyDocumentService;
use App\Domain\Document\GroupPolicyDocument\GroupPolicyDocumentRepository;
use App\Enums\DocumentType\DocumentType as EDocumentType;
use App\Models\DocumentType;
use App\Models\GroupPolicyDocument;
use App\Models\GroupPolicySetting;
use Tests\TestCase;

class GroupPolicyDocumentServiceTest extends TestCase
{
    protected function getService($repository)
    {
        return new GroupPolicyDocumentService($repository);
    }

    protected function getRepository()
    {
        return $this->createMock(GroupPolicyDocumentRepository::class);
    }

    public function test_get_group_policy_document_by_group_policy_setting_ids(): void
    {
        $documentType = DocumentType::factory()->create(['type' => EDocumentType::POLICY_DOCUMENT]);
        $groupPolicySetting = GroupPolicySetting::factory()->create();
        $groupPolicyDocuments = GroupPolicyDocument::factory()->count(5)->create([
            'pcm_group_policy_setting_uuid' => $groupPolicySetting->uuid,
            'pcm_document_type_uuid' => $documentType->uuid,
        ]);

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getGroupPolicyDocumentByGroupPolicySettingIds')
            ->willReturn($groupPolicyDocuments);

        $service = $this->getService($repository);

        $this->assertEmpty($service->getDocuments());

        $service->getDocumentByIds([$groupPolicySetting->uuid], $documentType->type);

        $this->assertNotEmpty($service->getDocuments());
        $this->assertCount(5, $service->getDocuments());
    }
}
