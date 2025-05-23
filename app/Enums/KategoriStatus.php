<?php

namespace App\Enums;

enum KategoriStatus: string
{
    case FOOD = 'food';
    case NONFOOD = 'nonfood';

    public function label(): string
    {
        return match($this) {
            self::FOOD => 'Food',
            self::NONFOOD => 'Nonfood'
        };
    }
}
