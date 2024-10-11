<?php

namespace App\Domain\Group;

use Symfony\Component\HttpKernel\Exception\HttpException;

class GroupException extends HttpException
{
    public static function groupNotFound(): self
    {
        return new self(404, 'group_not_found');
    }
}
