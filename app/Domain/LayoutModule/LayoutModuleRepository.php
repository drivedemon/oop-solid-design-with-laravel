<?php

namespace App\Domain\LayoutModule;

use App\Models\LayoutModule;

class LayoutModuleRepository
{
    private LayoutModule $layoutModule;

    public function __construct(LayoutModule $layoutModule)
    {
        $this->layoutModule = $layoutModule;
    }

    public function findOrFail(string $uuid): LayoutModule
    {
        return $this->layoutModule->findOrFail($uuid);
    }
}
