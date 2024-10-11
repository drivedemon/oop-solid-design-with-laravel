<?php

namespace App\Enums\User;

enum AccountStatus: int
{
    case ACTIVE = 0;
    case HR_APPROVE = 1;
    case SENT_INVITATION = 2;
    case INACTIVE = 3;
    case OUT_OF_DATE = 4;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::HR_APPROVE => 'HrApprove',
            self::SENT_INVITATION => 'SentInvitation',
            self::INACTIVE => 'Inactive',
            self::OUT_OF_DATE => 'OutOfDate',
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
