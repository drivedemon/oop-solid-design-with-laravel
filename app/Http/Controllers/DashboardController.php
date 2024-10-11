<?php

namespace App\Http\Controllers;

use App\Domain\Group\GroupException;
use App\Domain\Layout\LayoutException;
use App\Domain\Layout\LayoutService;
use App\Domain\LayoutModule\LayoutModuleService;
use App\Domain\UserGroup\UserGroupException;
use App\Domain\UserGroup\UserGroupService;
use App\Http\Resources\LayoutModuleResource;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    private LayoutModuleService $layoutModuleService;
    private LayoutService $layoutService;
    private UserGroupService $userGroupService;

    public function __construct(
        LayoutModuleService $layoutModuleService,
        LayoutService $layoutService,
        UserGroupService $userGroupService
    ) {
        $this->layoutModuleService = $layoutModuleService;
        $this->layoutService = $layoutService;
        $this->userGroupService = $userGroupService;
    }

    public function index(): JsonResponse
    {
        $user = auth()->user();

        try {
            $this->userGroupService->getUserGroupByUserId($user->uuid);
            $this->layoutService->getLayoutWithModuleByIds(
                $this->userGroupService->getUserGroups()->pluck('pcm_layout_uuid')->toArray()
            );
            $this->layoutService->matchedLayoutWithUserGroups($this->userGroupService->getUserGroups());
            $this->layoutModuleService->setUniqueModuleFromLayouts($this->layoutService->getLayouts());

            return $this->successResponse(LayoutModuleResource::collection($this->layoutModuleService->getModules()));
        } catch (GroupException|LayoutException|UserGroupException $exception) {
            return $this->exceptionResponse($exception);
        }
    }
}
