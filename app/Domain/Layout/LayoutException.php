<?php

namespace App\Domain\Layout;

use Symfony\Component\HttpKernel\Exception\HttpException;

class LayoutException extends HttpException
{
    public static function layoutNotFound(): self
    {
        return new self(404, 'layout_not_found');
    }
}
