<?php

namespace App\Enums\LayoutModule;

enum ModuleName: string
{
    case BENEFIT_COVERAGE = 'benefit_coverage';
    case POLICY_DOCUMENT = 'policy_document';
    case SUBMIT_CLAIM = 'submit_claim';
    case TRACK_CLAIM = 'track_claim';
    case ECARD = 'ecard';
    case CLINICS = 'clinics';
    case ARTICLE = 'article';

    public function label(): string
    {
        return match ($this) {
            self::BENEFIT_COVERAGE => 'Benefit Coverage',
            self::POLICY_DOCUMENT => 'Policy Document',
            self::SUBMIT_CLAIM => 'Submit Claim',
            self::TRACK_CLAIM => 'Track Claim',
            self::ECARD => 'eCard',
            self::CLINICS => 'Clinics',
            self::ARTICLE => 'Article',
        };
    }

    public function sequential(): int
    {
        return match ($this) {
            self::BENEFIT_COVERAGE => 1,
            self::POLICY_DOCUMENT => 2,
            self::SUBMIT_CLAIM => 3,
            self::TRACK_CLAIM => 4,
            self::ECARD => 5,
            self::CLINICS => 6,
            self::ARTICLE => 7,
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
