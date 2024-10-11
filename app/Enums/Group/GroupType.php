<?php

namespace App\Enums\Group;

enum GroupType: int
{
    case PCP = 0;
    case INDIVIDUAL = 1;
    case CXA = 2;

    public function label(): string
    {
        return match ($this) {
            self::PCP => 'PCP',
            self::INDIVIDUAL => 'Individual',
            self::CXA => 'CXA',
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
