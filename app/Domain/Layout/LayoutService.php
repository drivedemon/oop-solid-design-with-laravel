<?php

namespace App\Domain\Layout;

use Illuminate\Database\Eloquent\Collection;

class LayoutService
{
    private Collection $layouts;
    private LayoutRepository $layoutRepository;

    public function __construct(LayoutRepository $layoutRepository)
    {
        $this->layouts = new Collection;
        $this->layoutRepository = $layoutRepository;
    }

    public function getLayouts(): Collection
    {
        return $this->layouts;
    }

    public function getLayoutWithModuleByIds(array $ids): self
    {
        $this->layouts = $this->layoutRepository->getLayoutWithModuleByIds($ids);

        if ($this->layouts->isEmpty()) {
            throw LayoutException::layoutNotFound();
        }

        return $this;
    }

    public function matchedLayoutWithUserGroups(Collection $userGroups): void
    {
        $notMatchedIndex = [];

        $this->getLayouts()->each(function ($layout, $index) use (&$notMatchedIndex, $userGroups) {
            $userGroup = $userGroups->where('pcm_layout_uuid', $layout->uuid)->first();
            if ($userGroup?->pcm_group_uuid !== $layout->pcm_group_uuid) {
                $notMatchedIndex[] = $index;
            }
        });

        $this->getLayouts()->forget($notMatchedIndex);
    }
}
