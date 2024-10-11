<?php

namespace App\Models;

use App\Enums\RecordStatus;
use App\Traits\EloquentDecodeHash;
use App\Traits\Hashidable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layout extends Model
{
    use EloquentDecodeHash;
    use HasFactory;
    use Hashidable;
    use UuidModel;

    protected $table = 'pcm_layout';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'is_default',
        'name',
        'pcm_group_uuid',
        'record_status',
    ];
    protected $casts = [
        'is_default' => 'boolean',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function layoutModules(): HasMany
    {
        return $this->hasMany(LayoutModule::class, 'pcm_layout_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
