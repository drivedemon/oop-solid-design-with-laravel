<?php

namespace App\Models;

use App\Enums\RecordStatus;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;
    use UuidModel;

    protected $table = 'pcm_policies';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'policy_id',
        'client_no',
        'policy_type',
        'proposer',
        'region',
        'policy_number',
        'insurance_company',
        'renewal_responsibility',
        'start_date',
        'policy_end_date',
        'service_office',
        'medical_responsibility',
        'medical_currency',
        'record_status',
    ];
    protected $casts = [
        'start_date' => 'timestamp',
        'policy_end_date' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];
}
