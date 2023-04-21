<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Status $resource
 */
final class StatusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'value' => $this->resource->value,
            'description' => $this->resource::description($this->resource),
        ];
    }
}
