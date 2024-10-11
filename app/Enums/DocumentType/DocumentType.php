<?php

namespace App\Enums\DocumentType;

enum DocumentType: int
{
    case POLICY_DOCUMENT = 0;
    case CLINIC = 1;
    case BENEFIT_COVERAGE = 2;

    public function label(): string
    {
        return match ($this) {
            self::POLICY_DOCUMENT => 'Policy Document',
            self::CLINIC => 'Clinic',
            self::BENEFIT_COVERAGE => 'Benefit Coverage',
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
