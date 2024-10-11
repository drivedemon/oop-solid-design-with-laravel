<?php

namespace App\Domain\UserGroup;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserGroupException extends HttpException
{
    public static function userGroupNotFound(): self
    {
        return new self(404, 'user_group_not_found');
    }
}
