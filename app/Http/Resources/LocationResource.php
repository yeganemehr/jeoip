<?php

namespace App\Http\Resources;

use App\DTOs\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Location $resource
 */
class LocationResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request)
    {
        return [
            'status' => true,
            'query' => $this->resource->ip,
            
            ...$this->resource->jsonSerialize(),
        ];
    }
}