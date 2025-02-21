<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'ref' => $this->ref,
            'description' => $this->description,
            'pricePurchase' => $this->pricePurchase,
            'unit_price' => $this->unit_price,
            'unit_price_min' => $this->unit_price_min,
            'unit_price_max' => $this->unit_price_max,
            'is_available' => $this->is_available,
        ];
        // return parent::toArray($request);
    }
}
