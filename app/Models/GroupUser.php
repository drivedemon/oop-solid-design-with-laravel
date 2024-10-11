<?php

namespace App\Models;

use App\Enums\RecordStatus;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupUser extends Model
{
    use HasFactory;
    use UuidModel;

    protected $table = 'pcm_group_user';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pcm_group_uuid',
        'pcm_user_uuid',
        'pcm_user_group_uuid',
        'census_uuid',
        'record_status',
    ];
    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function userGroup(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class, 'pcm_user_group_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pcm_user_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
