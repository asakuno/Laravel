<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Estate;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class SearchEstateData extends Data
{
    public function __construct(
        public readonly ?string $priceClassification,
        public readonly int $year,
        public readonly ?int $quarter,
        public readonly ?string $area,
        public readonly ?int $city,
        public readonly string $language = 'ja',
    ){
    }
}
