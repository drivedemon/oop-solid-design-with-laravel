<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as BasePersonalAccessToken;

class PersonalAccessToken extends BasePersonalAccessToken
{
    protected $table = 'pcm_personal_access_tokens';
}
