<?php

namespace App\Traits;

trait EloquentDecodeHash
{
    public static function decodeHash($hash): string
    {
        try {
            $hex = \gmp_strval(\gmp_init($hash, 10), 16);
            $hex = str_pad($hex, 32, '0', STR_PAD_LEFT);

            return substr($hex, 0, 8).'-'.
                substr($hex, 8, 4).'-'.
                substr($hex, 12, 4).'-'.
                substr($hex, 16, 4).'-'.
                substr($hex, 20, 12);
        } catch (\ValueError $exception) {
            return '-1';
        }
    }
}
