<?php

namespace App\Domain\GroupPolicySetting;

use Symfony\Component\HttpKernel\Exception\HttpException;

class GroupPolicySettingException extends HttpException
{
    public static function groupPolicySettingNotFound(): self
    {
        return new self(404, 'group_policy_setting_not_found');
    }
}
