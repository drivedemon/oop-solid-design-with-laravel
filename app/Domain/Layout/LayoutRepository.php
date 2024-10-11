<?php

namespace App\Domain\Layout;

use App\Enums\RecordStatus;
use App\Models\Layout;
use Illuminate\Database\Eloquent\Collection;

class LayoutRepository
{
    private Layout $layout;

    public function __construct(Layout $layout)
    {
        $this->layout = $layout;
    }

    public function getLayoutWithModuleByIds(array $ids): Collection
    {
        return $this->layout->with([
            'layoutModules' => function ($query) {
                $query->orderBy('sequential');
            },
        ])
            ->whereIn('uuid', $ids)
            ->where('is_default', true)
            ->where('record_status', RecordStatus::NORMAL)
            ->get();
    }
}
