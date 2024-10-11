<?php

namespace App\Enums\CensusPolicy;

enum FamilyStatus: string
{
    case SINGLE = 'Single';
    case SINGLE_PARENT = 'SingleParent';
    case COUPLE = 'Couple';
    case FAMILY = 'Family';
    case MARRIED = 'Married';
    case LARGE_FAMILY = 'LargeFamily';
    case INVALID = 'INVALID';
    case UNKNOWN = 'UNKNOWN';

    public function label(): string
    {
        return match ($this) {
            self::SINGLE => 'Single',
            self::SINGLE_PARENT => 'Single Parent',
            self::COUPLE => 'Couple',
            self::FAMILY => 'Family',
            self::MARRIED => 'Married',
            self::LARGE_FAMILY => 'Large Family',
            self::INVALID => 'INVALID',
            self::UNKNOWN => 'UNKNOWN',
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
