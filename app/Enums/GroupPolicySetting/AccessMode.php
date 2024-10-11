<?php

namespace App\Enums\GroupPolicySetting;

enum AccessMode: int
{
    case HIDE = 0;
    case READ = 1;
    case WRITE = 2;

    public function label(): string
    {
        return match ($this) {
            self::HIDE => 'Hide',
            self::READ => 'Read',
            self::WRITE => 'Write',
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
