<?php

namespace App\Http\Resources\Estate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchEstatePriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this['status'],
            'data' => EstateItemResource::collection($this['data'] ?? []),
        ];
    }
}
