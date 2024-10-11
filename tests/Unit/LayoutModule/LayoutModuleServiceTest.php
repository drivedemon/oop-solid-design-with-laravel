<?php

namespace Tests\Unit\LayoutModule;

use App\Domain\LayoutModule\LayoutModuleService;
use App\Models\Layout;
use App\Models\LayoutModule;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class LayoutModuleServiceTest extends TestCase
{
    protected function getService(): LayoutModuleService
    {
        return new LayoutModuleService();
    }

    public function test_set_unique_module_from_layouts(): void
    {
        $layouts = Layout::factory()->count(5)->has(LayoutModule::factory()->count(3))->create();
        $expectedModules = new Collection(
            $layouts->pluck('layoutModules')
                ->flatten()
                ->unique('module_name')
                ->sortBy('sequential')
                ->values()
        );

        $service = $this->getService();
        $this->assertEmpty($service->getModules());

        $service->setUniqueModuleFromLayouts($layouts);

        $this->assertNotEmpty($service->getModules());
        $this->assertInstanceOf(Collection::class, $service->getModules());
        $this->assertEquals($expectedModules->pluck('uuid'), $service->getModules()->pluck('uuid'));
    }

    public function test_set_unique_module_from_layouts_when_module_is_empty(): void
    {
        $layouts = Layout::factory()->count(5)->create();

        $service = $this->getService();
        $this->assertEmpty($service->getModules());

        $service->setUniqueModuleFromLayouts($layouts);

        $this->assertEmpty($service->getModules());
    }
}
