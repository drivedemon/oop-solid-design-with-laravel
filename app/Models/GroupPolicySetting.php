<?php

namespace App\Models;

use App\Enums\GroupPolicySetting\AccessMode;
use App\Enums\GroupPolicySetting\ClaimManagementType;
use App\Enums\RecordStatus;
use App\Traits\EloquentDecodeHash;
use App\Traits\Hashidable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupPolicySetting extends Model
{
    use EloquentDecodeHash;
    use HasFactory;
    use Hashidable;
    use UuidModel;

    protected $table = 'pcm_group_policy_setting';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pcm_group_uuid',
        'pcm_policy_uuid',
        'access_mode',
        'policy_name',
        'policy_number',
        'insurer_name',
        'proposer_name',
        'claim_management_type',
        'claim_buffer_day',
        'effective_date',
        'record_status',
    ];
    protected $casts = [
        'access_mode' => AccessMode::class,
        'claim_management_type' => ClaimManagementType::class,
        'effective_date' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'pcm_group_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }

    public function policy(): BelongsTo
    {
        return $this->belongsTo(Policy::class, 'pcm_policy_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
