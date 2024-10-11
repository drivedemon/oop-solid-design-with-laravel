<?php

namespace App\Models;

use App\Enums\CensusPolicy\AdultChildStatus;
use App\Enums\CensusPolicy\CensusPolicyStatus;
use App\Enums\CensusPolicy\MaritalStatus;
use App\Enums\RecordStatus;
use App\Enums\User\Gender;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CensusPolicy extends Model
{
    use HasFactory;
    use UuidModel;

    protected $table = 'pcm_census_policy';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pcm_user_uuid',
        'pcm_policies_uuid',
        'region',
        'client_number',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender',
        'employee_id',
        'policy_number',
        'family_id',
        'nationality',
        'location',
        'group_code',
        'plan',
        'job_title',
        'area_of_cover',
        'department',
        'company_name',
        'status',
        'marital_status',
        'adult_child',
        'census_status',
        'family_status',
        'email_address',
        'mobile_phone_number',
        'start_of_cover',
        'end_of_cover',
        'member_join_date',
        'effective_date',
        'date_of_hire',
        'day_of_cover',
        'passport_number',
        'passport_expiry_date',
        'passport_photo_name',
        'visa_unified_number',
        'visa_file_number',
        'visa_photo_name',
        'require_document',
        'record_status',
    ];
    protected $casts = [
        'gender' => Gender::class,
        'status' => CensusPolicyStatus::class,
        'marital_status' => MaritalStatus::class,
        'adult_child' => AdultChildStatus::class,
        'family_status' => AdultChildStatus::class,
        'start_of_cover' => 'timestamp',
        'end_of_cover' => 'timestamp',
        'member_join_date' => 'timestamp',
        'date_of_hire' => 'timestamp',
        'passport_expiry_date' => 'timestamp',
        'visa_expiration_date' => 'timestamp',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];
}
