<?php

namespace App\Models;

use App\Enums\RecordStatus;
use App\Traits\EloquentDecodeHash;
use App\Traits\Hashidable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserGroup extends Model
{
    use EloquentDecodeHash;
    use HasFactory;
    use Hashidable;
    use UuidModel;

    protected $table = 'pcm_user_group';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pcm_group_uuid',
        'pcm_layout_uuid',
        'is_custom',
        'name',
        'factor_1',
        'factor_2',
        'factor_3',
        'factor_4',
        'factor_1_column_name',
        'factor_2_column_name',
        'factor_3_column_name',
        'factor_4_column_name',
        'logo_path',
        'color',
        'record_status',
    ];
    protected $casts = [
        'is_custom' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'pcm_group_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }

    public function groupUsers(): HasMany
    {
        return $this->hasMany(GroupUser::class, 'pcm_user_group_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
