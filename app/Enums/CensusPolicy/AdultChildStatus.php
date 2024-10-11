<?php

namespace App\Enums\CensusPolicy;

enum AdultChildStatus: string
{
    case ADULT = 'Adult';
    case CHILD = 'Child';
    case NA = 'N/A';

    public function label(): string
    {
        return match ($this) {
            self::ADULT => 'Adult',
            self::CHILD => 'Child',
            self::NA => 'N/A',
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
