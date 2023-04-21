<?php

declare(strict_types=1);

namespace App\Http\Resources\Web;

use App\Enums\Category;
use App\Enums\Status;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DateResource;
use App\Http\Resources\StatusResource;
use App\Models\User;
use App\Models\Vote;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $description
 * @property-read Status $status
 * @property-read Category $category
 * @property-read int $votes
 * @property-read User $user
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class IdeaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => new StatusResource(
                resource: $this->status,
            ),
            'category' => new CategoryResource(
                resource: $this->category,
            ),
            'votes' => $this->votes,
            'user' => new UserResource(
                resource: $this->whenLoaded('user'),
            ),
            'created' => new DateResource(
                resource: $this->created_at,
            ),
            'updated' => new DateResource(
                resource: $this->updated_at,
            ),
            'voted' => Auth::check()
                ? (bool) Vote::query()->where('idea_id', $this->id)->where('user_id', Auth::id())->count()
                : false,
        ];
    }
}
