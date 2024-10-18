<?php

namespace App\Enums\Policy;

enum PolicyType: string
{
    case MEDICAL = 'medical';
    case LIFE = 'life';

    public function label(): string
    {
        return match ($this) {
            self::MEDICAL => 'Medical',
            self::LIFE => 'Life',
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
