<?php

namespace App\Models;

use App\Enums\Group\GroupType;
use App\Enums\RecordStatus;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;
    use UuidModel;

    protected $table = 'pcm_group';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pcp_group_uuid',
        'pcm_group_name',
        'responsibility_uuid',
        'secondary_responsibility',
        'group_type',
        'record_status',
    ];
    protected $casts = [
        'group_type' => GroupType::class,
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function groupPolicySettings(): HasMany
    {
        return $this->hasMany(GroupPolicySetting::class, 'pcm_group_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }

    public function userGroups(): HasMany
    {
        return $this->hasMany(UserGroup::class, 'pcm_group_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
