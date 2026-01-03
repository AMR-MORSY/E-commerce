<?php
namespace App\Enums;

enum DivisionsEnum: string
{
    case MEN = "MN";
    case WOMEN = "WMN";
    case KIDS = "KID";
    public function label(): string
    {
        return match($this) {
            self::MEN => 'Men',
            self::WOMEN => 'Women',
            self::KIDS => 'Kids',
        };
    }
}

