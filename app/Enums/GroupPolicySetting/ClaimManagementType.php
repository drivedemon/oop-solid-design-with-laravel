<?php

namespace App\Enums\GroupPolicySetting;

enum ClaimManagementType: int
{
    case CLAIM_RULE_1 = 0;
    case CLAIM_RULE_2 = 1;
    case CLAIM_RULE_3 = 2;

    public function label(): string
    {
        return match ($this) {
            self::CLAIM_RULE_1 => 'Claim Management Type 1',
            self::CLAIM_RULE_2 => 'Claim Management Type 2',
            self::CLAIM_RULE_3 => 'Claim Management Type 3',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::CLAIM_RULE_1 => 'Employee can claim Employee & Spouse, Spouse can claim Spouse',
            self::CLAIM_RULE_2 => 'Employee can claim Employee & Spouse, Spouse can\'t claim Spouse',
            self::CLAIM_RULE_3 => 'Employee can claim Employee, Spouse can claim Spouse',
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
