<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Permission $resource
 */
final class PermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'key' => $this->resource->key($this->resource),
            'name' => $this->resource->name,
            'value' => $this->resource->value,
            'description' => $this->resource->description($this->resource),
            'abilities' => $this->resource->abilities($this->resource),
        ];
    }
}
