<?php

namespace App\Enums\User;

enum Role: string
{
    case USER = 'USER';
    case SECURITY = 'SECURITY';

    public function label(): string
    {
        return match ($this) {
            self::USER => 'User',
            self::SECURITY => 'Security',
        };
    }

    public static function all(): array
    {
        $cases = self::cases();

        $result = [];
        foreach ($cases as $case) {
            $result[$case->value] = $case->label();
        }

        return $result;
    }
}
