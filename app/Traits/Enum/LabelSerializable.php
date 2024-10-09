<?php

declare(strict_types=1);

namespace App\Traits\Enum;

trait LabelSerializable
{
    /**
     * values
     *
     * @return array<int>
     */
    public function values(): array
    {
        return [
            'label' => $this->label(),
            'value' => $this->value(),
        ];
    }
}
