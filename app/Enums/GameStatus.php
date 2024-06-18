<?php
namespace App\Enums;


enum GameStatus:int{

    case pending = 1;
    case active = 2;
    case expired = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
    
}   