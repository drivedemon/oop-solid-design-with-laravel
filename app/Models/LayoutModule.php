<?php

namespace App\Models;

use App\Enums\LayoutModule\ModuleName;
use App\Enums\RecordStatus;
use App\Traits\EloquentDecodeHash;
use App\Traits\Hashidable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LayoutModule extends Model
{
    use EloquentDecodeHash;
    use HasFactory;
    use Hashidable;
    use UuidModel;

    protected $table = 'pcm_layout_module';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'module_name',
        'display_name',
        'sequential',
        'pcm_layout_uuid',
        'record_status',
    ];
    protected $casts = [
        'module_name' => ModuleName::class,
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function layout(): BelongsTo
    {
        return $this->belongsTo(Layout::class, 'pcm_user_group_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
