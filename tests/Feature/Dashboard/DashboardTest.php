<?php

namespace Tests\Feature\Dashboard;

use App\Domain\Group\GroupException;
use App\Domain\Layout\LayoutException;
use App\Domain\UserGroup\UserGroupException;
use App\Enums\LayoutModule\ModuleName;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Layout;
use App\Models\LayoutModule;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_user_get_dashboard(): void
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $layout = Layout::factory()->create(['pcm_group_uuid' => $group->uuid]);
        LayoutModule::factory()
            ->count(3)
            ->state(
                new Sequence(
                    [
                        'module_name' => ModuleName::BENEFIT_COVERAGE->value,
                        'display_name' => ModuleName::BENEFIT_COVERAGE->label(),
                        'sequential' => ModuleName::BENEFIT_COVERAGE->sequential(),
                    ],
                    [
                        'module_name' => ModuleName::POLICY_DOCUMENT->value,
                        'display_name' => ModuleName::POLICY_DOCUMENT->label(),
                        'sequential' => ModuleName::POLICY_DOCUMENT->sequential(),
                    ],
                    [
                        'module_name' => ModuleName::SUBMIT_CLAIM->value,
                        'display_name' => ModuleName::SUBMIT_CLAIM->label(),
                        'sequential' => ModuleName::SUBMIT_CLAIM->sequential(),
                    ],
                )
            )
            ->create(['pcm_layout_uuid' => $layout->uuid]);
        $userGroup = UserGroup::factory()->create([
            'pcm_group_uuid' => $group->uuid,
            'pcm_layout_uuid' => $layout->uuid,
        ]);
        GroupUser::factory()->for($userGroup)->create([
            'pcm_group_uuid' => $group->uuid,
            'pcm_user_uuid' => $user->uuid,
        ]);

        $this->signIn($user);

        $response = $this->get(route('dashboard.index'));
        $response->assertStatus(200);
        $response = $response->json();

        $this->assertNotEmpty($response['data']);
        $this->assertCount(3, $response['data']);
        $this->assertSame(
            [ModuleName::BENEFIT_COVERAGE->value, ModuleName::POLICY_DOCUMENT->value, ModuleName::SUBMIT_CLAIM->value],
            Arr::pluck($response['data'], 'module_name')
        );
    }

    public function test_user_get_dashboard_when_user_group_not_found_then_return_user_group_not_found(): void
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $layout = Layout::factory()->create(['pcm_group_uuid' => $group->uuid]);
        UserGroup::factory()->create([
            'pcm_group_uuid' => $group->uuid,
            'pcm_layout_uuid' => $layout->uuid,
        ]);

        $this->signIn($user);

        $response = $this->get(route('dashboard.index'));
        $response->assertStatus(404);
        $response = $response->json();

        $this->assertSame(UserGroupException::userGroupNotFound()->getMessage(), $response['message']);
    }

    public function test_user_get_dashboard_when_group_not_found_then_return_group_not_found(): void
    {
        $user = User::factory()->create();
        $layout = Layout::factory()->create(['pcm_group_uuid' => Str::uuid()->toString()]);
        $userGroup = UserGroup::factory()->create([
            'pcm_group_uuid' => Str::uuid()->toString(),
            'pcm_layout_uuid' => $layout->uuid,
        ]);
        GroupUser::factory()->for($userGroup)->create([
            'pcm_group_uuid' => Str::uuid()->toString(),
            'pcm_user_uuid' => $user->uuid,
        ]);

        $this->signIn($user);

        $response = $this->get(route('dashboard.index'));
        $response->assertStatus(404);
        $response = $response->json();

        $this->assertSame(GroupException::groupNotFound()->getMessage(), $response['message']);
    }

    public function test_user_get_dashboard_when_layout_not_found_then_return_layout_not_found(): void
    {
        $user = User::factory()->create();
        $group = Group::factory()->create();
        $userGroup = UserGroup::factory()->create([
            'pcm_group_uuid' => $group->uuid,
            'pcm_layout_uuid' => Str::uuid()->toString(),
        ]);
        GroupUser::factory()->for($userGroup)->create([
            'pcm_group_uuid' => $group->uuid,
            'pcm_user_uuid' => $user->uuid,
        ]);

        $this->signIn($user);

        $response = $this->get(route('dashboard.index'));
        $response->assertStatus(404);
        $response = $response->json();

        $this->assertSame(LayoutException::layoutNotFound()->getMessage(), $response['message']);
    }
}
