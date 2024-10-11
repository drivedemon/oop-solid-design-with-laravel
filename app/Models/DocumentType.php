<?php

namespace App\Models;

use App\Enums\DocumentType\ActiveStatus;
use App\Enums\DocumentType\DocumentType as EDocumentType;
use App\Enums\RecordStatus;
use App\Traits\EloquentDecodeHash;
use App\Traits\Hashidable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    use EloquentDecodeHash;
    use HasFactory;
    use Hashidable;
    use UuidModel;

    protected $table = 'pcm_document_type';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'type',
        'is_active',
    ];
    protected $casts = [
        'type' => EDocumentType::class,
        'is_active' => ActiveStatus::class,
    ];

    public function userDocuments(): HasMany
    {
        return $this->hasMany(UserDocument::class, 'pcm_document_type_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
