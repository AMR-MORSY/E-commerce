<?php

namespace App\Enums;

enum CategoriesEnum: string
{
    case T_SHIRTS = "TSH";
    case SHIRTS = "SHR";
    case PANTS = "PNS";
    case SHORTS = "SHO";
    case JACKETS = "JKT";
    case COATS = "COA";
    case DRESSES = "DRE";
    case SKIRTS = "SKI";
    case OTHER = "OTH";

    public function label(): string
    {
        return match($this) {
            self::T_SHIRTS => 'T-Shirts',
            self::SHIRTS => 'Shirts',
            self::PANTS => 'Pants',
            self::SHORTS => 'Shorts',
            self::JACKETS => 'Jackets',
            self::COATS => 'Coats',
            self::DRESSES => 'Dresses',
            self::SKIRTS => 'Skirts',
            self::OTHER => 'Other',
        };
    }
}

