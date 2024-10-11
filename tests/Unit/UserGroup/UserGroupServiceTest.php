<?php

namespace Tests\Unit\UserGroup;

use App\Domain\Group\GroupException;
use App\Domain\UserGroup\UserGroupException;
use App\Domain\UserGroup\UserGroupRepository;
use App\Domain\UserGroup\UserGroupService;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserGroupServiceTest extends TestCase
{
    protected function getService($repository): UserGroupService
    {
        return new UserGroupService($repository);
    }

    protected function getRepository()
    {
        return $this->createMock(UserGroupRepository::class);
    }

    public function test_get_user_group_by_user_id(): void
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $userGroup = UserGroup::factory()->create([
            'pcm_group_uuid' => $group->uuid,
        ]);
        GroupUser::factory()->for($userGroup)->create([
            'pcm_group_uuid' => $group->uuid,
            'pcm_user_uuid' => $user->uuid,
        ]);
        $userGroup->load(['group', 'groupUsers.user']);

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getUserGroupByUserId')
            ->willReturn(new Collection([$userGroup]));

        $service = $this->getService($repository);
        $this->assertEmpty($service->getUserGroups());

        $service->getUserGroupByUserId($user->uuid);

        $this->assertNotEmpty($service->getUserGroups());
        $service->getUserGroups()->each(function ($userGroup) {
            $this->assertInstanceOf(UserGroup::class, $userGroup);
        });
    }

    public function test_get_user_group_by_user_id_when_group_is_empty_then_return_throw_group_not_found_exception(): void
    {
        $this->expectException(GroupException::class);
        $this->expectExceptionMessage(GroupException::groupNotFound()->getMessage());

        $user = User::factory()->create();
        $userGroup = UserGroup::factory()->create([
            'pcm_group_uuid' => Str::uuid()->toString(),
        ]);
        GroupUser::factory()->for($userGroup)->create([
            'pcm_group_uuid' => Str::uuid()->toString(),
            'pcm_user_uuid' => $user->uuid,
        ]);

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getUserGroupByUserId')
            ->willReturn(new Collection([$userGroup]));

        $service = $this->getService($repository);
        $service->getUserGroupByUserId($user->uuid);
    }

    public function test_get_user_group_by_user_id_when_user_group_is_empty_then_return_throw_user_group_not_found_exception(): void
    {
        $this->expectException(UserGroupException::class);
        $this->expectExceptionMessage(UserGroupException::userGroupNotFound()->getMessage());

        $user = User::factory()->create();

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getUserGroupByUserId')
            ->willReturn(new Collection([]));

        $service = $this->getService($repository);
        $service->getUserGroupByUserId($user->uuid);
    }
}
