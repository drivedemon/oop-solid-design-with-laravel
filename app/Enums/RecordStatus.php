<?php

namespace App\Enums;

enum RecordStatus: int
{
    case NORMAL = 0;
    case INVALID = 1;
    case EXPIRED = 2;
    case SOFT_DELETED = 3;
    case DISABLED = 4;
    case HARD_DELETED = 5;
    case PROCESSING = 6;
    case COMPLETED = 7;
    case SEEN = 8;
    case PENDING = 9;

    public function label(): string
    {
        return match ($this) {
            self::NORMAL => 'Normal',
            self::INVALID => 'Invalid',
            self::EXPIRED => 'Expired',
            self::SOFT_DELETED => 'SoftDeleted',
            self::DISABLED => 'Disabled',
            self::HARD_DELETED => 'HardDeleted',
            self::PROCESSING => 'Processing',
            self::COMPLETED => 'Completed',
            self::SEEN => 'Seen',
            self::PENDING => 'Pending',
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
