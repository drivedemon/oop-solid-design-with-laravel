<?php

namespace Document;

use App\Domain\Document\Adapters\UserDocumentService;
use App\Domain\Document\UserDocument\UserDocumentRepository;
use App\Enums\DocumentType\DocumentType as EDocumentType;
use App\Models\DocumentType;
use App\Models\User;
use App\Models\UserDocument;
use Tests\TestCase;

class UserDocumentServiceTest extends TestCase
{
    protected function getService($repository)
    {
        return new UserDocumentService($repository);
    }

    protected function getRepository()
    {
        return $this->createMock(UserDocumentRepository::class);
    }

    public function test_get_user_document_by_user_ids(): void
    {
        $user = User::factory()->create();
        $documentType = DocumentType::factory()->create(['type' => EDocumentType::POLICY_DOCUMENT]);
        $userDocuments = UserDocument::factory()->count(5)->create([
            'pcm_user_uuid' => $user->uuid,
            'pcm_document_type_uuid' => $documentType->uuid,
        ]);

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getUserDocumentByUserIds')
            ->willReturn($userDocuments);

        $service = $this->getService($repository);

        $this->assertEmpty($service->getDocuments());

        $service->getDocumentByIds([$user->uuid], $documentType->type);

        $this->assertNotEmpty($service->getDocuments());
        $this->assertCount(5, $service->getDocuments());
    }
}
