<?php

namespace App\Http\Resources\Estate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstateItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'priceCategory' => $this['PriceCategory'] ?? null,
            'type' => $this['Type'] ?? null,
            'region' => $this['Region'] ?? null,
            'municipalityCode' => $this['MunicipalityCode'] ?? null,
            'prefecture' => $this['Prefecture'] ?? null,
            'municipality' => $this['Municipality'] ?? null,
            'districtName' => $this['DistrictName'] ?? null,
            'tradePrice' => isset($this['TradePrice']) ? (int) $this['TradePrice'] : null,
            'pricePerUnit' => isset($this['PricePerUnit']) ? (int) $this['PricePerUnit'] : null,
            'floorPlan' => $this['FloorPlan'] ?? null,
            'area' => isset($this['Area']) ? (float) $this['Area'] : null,
            'unitPrice' => isset($this['UnitPrice']) ? (int) $this['UnitPrice'] : null,
            'landShape' => $this['LandShape'] ?? null,
            'frontage' => isset($this['Frontage']) ? (float) $this['Frontage'] : null,
            'totalFloorArea' => isset($this['TotalFloorArea']) ? (float) $this['TotalFloorArea'] : null,
            'buildingYear' => $this['BuildingYear'] ?? null,
            'structure' => $this['Structure'] ?? null,
            'use' => $this['Use'] ?? null,
            'purpose' => $this['Purpose'] ?? null,
            'remarks' => $this['Remarks'] ?? null,
        ];
    }
}
