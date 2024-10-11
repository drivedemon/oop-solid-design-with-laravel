<?php

namespace App\Http\Controllers;

use App\Domain\Document\DocumentService;
use App\Domain\Group\GroupException;
use App\Domain\GroupPolicySetting\GroupPolicySettingException;
use App\Domain\GroupPolicySetting\GroupPolicySettingService;
use App\Domain\UserGroup\UserGroupException;
use App\Domain\UserGroup\UserGroupService;
use App\Enums\DocumentType\DocumentType;
use App\Http\Resources\DocumentResource;
use Illuminate\Http\JsonResponse;

class PolicyDocumentController extends Controller
{
    private DocumentService $documentService;
    private GroupPolicySettingService $groupPolicySettingService;
    private UserGroupService $userGroupService;

    public function __construct(
        DocumentService $documentService,
        GroupPolicySettingService $groupPolicySettingService,
        UserGroupService $userGroupService
    ) {
        $this->documentService = $documentService;
        $this->userGroupService = $userGroupService;
        $this->groupPolicySettingService = $groupPolicySettingService;
    }

    public function index(): JsonResponse
    {
        $groupIds = [];
        $userGroupIds = [];
        $user = auth()->user();

        try {
            $this->userGroupService->getUserGroupByUserId($user->uuid);

            $userGroupIds = $this->userGroupService->getUserGroups()->pluck('uuid')->toArray();
            $groupIds = $this->userGroupService->getUserGroups()->pluck('group')->pluck('uuid')->unique()->toArray();

            $this->groupPolicySettingService->getGroupPolicySettingByGroupIds($groupIds);
        } catch (GroupException|GroupPolicySettingException|UserGroupException $exception) {
        }

        $this->documentService->setDocumentType(DocumentType::POLICY_DOCUMENT);
        $this->documentService->getGroupPolicyDocumentByGroupPolicySettingIds(
            $this->groupPolicySettingService->getGroupPolicySettings()->pluck('uuid')->toArray()
        );
        $this->documentService->getUserDocumentByUserId($user->uuid);
        $this->documentService->getUserGroupDocumentByUserGroupIds($userGroupIds);

        return $this->successResponse([
            'group_policy_documents' => DocumentResource::collection($this->documentService->getGroupPolicyDocuments()),
            'user_documents' => DocumentResource::collection($this->documentService->getUserDocuments()),
            'user_group_documents' => DocumentResource::collection($this->documentService->getUserGroupDocuments()),
        ]);
    }
}
