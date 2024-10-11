<?php

namespace App\Traits;

trait Hashidable
{
    public function getRouteKey(): string
    {
        return static::encodeHash($this->getKey());
    }

    public function getHashidAttribute(): string
    {
        return static::encodeHash($this->attributes['uuid']);
    }

    public static function encodeHash($uuid): string
    {
        $hexUuid = str_replace('-', '', $uuid);

        return \gmp_strval(\gmp_init($hexUuid, 16), 10);
    }
}
