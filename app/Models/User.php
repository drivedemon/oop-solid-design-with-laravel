<?php

namespace App\Models;

use App\Enums\RecordStatus;
use App\Enums\User\AccountStatus;
use App\Enums\User\Gender;
use App\Enums\User\Role;
use App\Traits\EloquentDecodeHash;
use App\Traits\Hashidable;
use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use EloquentDecodeHash;
    use HasApiTokens;
    use HasFactory;
    use Hashidable;
    use Notifiable;
    use UuidModel;

    protected $table = 'pcm_user';
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'email',
        'billing_address',
        'phone_number',
        'last_name',
        'first_name',
        'dob',
        'gender',
        'record_status',
    ];
    protected $casts = [
        'account_status' => AccountStatus::class,
        'dob' => 'timestamp',
        'gender' => Gender::class,
        'role' => Role::class,
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'record_status' => RecordStatus::class,
    ];

    public function groupUsers(): HasMany
    {
        return $this->hasMany(GroupUser::class, 'pcm_user_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }

    public function userDocuments(): HasMany
    {
        return $this->hasMany(UserDocument::class, 'pcm_user_uuid', 'uuid')
            ->where('record_status', RecordStatus::NORMAL);
    }
}
