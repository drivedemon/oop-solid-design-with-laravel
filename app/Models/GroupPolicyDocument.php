<?php

namespace App\Models;

use App\Enums\DocumentType\ActiveStatus;
use App\Enums\RecordStatus;
use App\Traits\EloquentDecodeHash;
use App\Traits\Hashidable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupPolicyDocument extends Model
{
    use EloquentDecodeHash;
    use HasFactory;
    use Hashidable;
    use UuidModel;

    protected $table = 'pcm_group_policy_document';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pcm_group_policy_setting_uuid',
        'file_name',
        'file_path',
        'sequential',
        'expiry_date',
        'pcm_document_type_uuid',
        'record_status',
    ];
    protected $casts = [
        'expiry_date' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'pcm_document_type_uuid', 'uuid')
            ->where('is_active', ActiveStatus::ACTIVE);
    }

    public function groupPolicySetting(): BelongsTo
    {
        return $this->belongsTo(GroupPolicySetting::class, 'pcm_group_policy_setting_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
