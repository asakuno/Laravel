<?php

declare(strict_types=1);

namespace App\Traits\Enum;

trait ArrayConvertible
{
    /**
     * values
     *
     * @return array<int>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * toArray
     *
     * @return array<string,string|int>
     */
    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'value' => $this->value
        ];
    }
}
