<?php

namespace App\Enums;

enum CareerWorkType: int
{

    case full_time = 1;
    case part_time = 2;
    case remotely = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
