<?php
namespace App\Enums;


enum VendorStatus:int{

    case blocked = 0;
    case pending = 1;
    case approved = 2;
    case rejected = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}   