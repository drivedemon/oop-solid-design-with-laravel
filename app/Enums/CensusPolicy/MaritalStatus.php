<?php

namespace App\Enums\CensusPolicy;

enum MaritalStatus: string
{
    case SINGLE = 'Single';
    case MARRIED = 'Married';

    public function label(): string
    {
        return match ($this) {
            self::SINGLE => 'Single',
            self::MARRIED => 'Married',
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
