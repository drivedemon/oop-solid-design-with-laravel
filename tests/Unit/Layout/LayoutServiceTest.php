<?php

namespace Tests\Unit\Layout;

use App\Domain\Layout\LayoutException;
use App\Domain\Layout\LayoutRepository;
use App\Domain\Layout\LayoutService;
use App\Models\Group;
use App\Models\Layout;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class LayoutServiceTest extends TestCase
{
    protected function getService($repository): LayoutService
    {
        return new LayoutService($repository);
    }

    protected function getRepository()
    {
        return $this->createMock(LayoutRepository::class);
    }

    public function test_get_layout_with_module_by_ids(): void
    {
        $layouts = Layout::factory()->count(5)->create();

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getLayoutWithModuleByIds')
            ->willReturn($layouts);

        $service = $this->getService($repository);
        $this->assertEmpty($service->getLayouts());

        $service->getLayoutWithModuleByIds($layouts->pluck('uuid')->toArray());

        $this->assertNotEmpty($service->getLayouts());
        $service->getLayouts()->each(function ($layout) {
            $this->assertInstanceOf(Layout::class, $layout);
        });
    }

    public function test_get_layout_with_module_by_ids_when_layout_is_empty_then_return_throw_layout_not_found_exception(): void
    {
        $this->expectException(LayoutException::class);
        $this->expectExceptionMessage(LayoutException::layoutNotFound()->getMessage());

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getLayoutWithModuleByIds')
            ->willReturn(new Collection([]));

        $service = $this->getService($repository);
        $service->getLayoutWithModuleByIds([1, 2, 3, 4]);
    }

    public function test_matched_layout_with_user_groups(): void
    {
        $group = Group::factory()->create();
        $layouts = Layout::factory()->count(5)->create(['pcm_group_uuid' => $group->uuid]);
        $expectedLayout = $layouts->first();
        $userGroups = UserGroup::factory()->count(5)->create([
            'pcm_layout_uuid' => $expectedLayout->uuid,
            'pcm_group_uuid' => $group->uuid,
        ]);

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('getLayoutWithModuleByIds')
            ->willReturn($layouts);

        $service = $this->getService($repository);
        $this->assertEmpty($service->getLayouts());
        $service->getLayoutWithModuleByIds($layouts->pluck('uuid')->toArray());

        $this->assertCount(5, $service->getLayouts());
        $service->matchedLayoutWithUserGroups($userGroups);

        $this->assertCount(1, $service->getLayouts());
        $this->assertSame($expectedLayout->toArray(), $service->getLayouts()->first()->toArray());
    }
}
