<?php

namespace App\Domain\Document\Adapters;

use App\Enums\DocumentType\DocumentType;
use Illuminate\Database\Eloquent\Collection;

interface ServiceInterface
{
    public function getDocuments(): Collection;

    public function getDocumentByIds(array $ids, DocumentType $documentType): self;
}
