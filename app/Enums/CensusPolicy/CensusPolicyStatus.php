<?php

namespace App\Enums\CensusPolicy;

enum CensusPolicyStatus: string
{
    case EMPLOYEE = 'Employee';
    case SPOUSE = 'Spouse';
    case CHILD = 'Child';

    public function label(): string
    {
        return match ($this) {
            self::EMPLOYEE => 'Employee',
            self::SPOUSE => 'Spouse',
            self::CHILD => 'Child',
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
