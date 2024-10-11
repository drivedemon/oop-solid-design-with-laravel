<?php

namespace App\Enums\DocumentType;

enum ActiveStatus: int
{
    case NON_ACTIVE = 0;
    case ACTIVE = 1;

    public function label(): string
    {
        return match ($this) {
            self::NON_ACTIVE => 'Non Active',
            self::ACTIVE => 'Active',
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
