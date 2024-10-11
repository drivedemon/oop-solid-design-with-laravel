<?php

namespace App\Domain\LayoutModule;

use Illuminate\Database\Eloquent\Collection;

class LayoutModuleService
{
    private Collection $modules;

    public function __construct()
    {
        $this->modules = new Collection();
    }

    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function setUniqueModuleFromLayouts(Collection $layouts): void
    {
        $layouts->pluck('layoutModules')
            ->flatten()
            ->unique('module_name')
            ->sortBy('sequential')
            ->values()
            ->each(function ($module) {
                $this->modules->add($module);
            });
    }
}
