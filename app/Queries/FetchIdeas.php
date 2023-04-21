<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Idea;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\QueryBuilder;

final class FetchIdeas
{
    public function handle(
        array $includes = [],
        array $filters = [],
    ): Builder {
        return QueryBuilder::for(
            subject: Idea::query()
        )->allowedIncludes(
            includes: $includes,
        )->allowedFilters(
            filters: $filters,
        )->getEloquentBuilder();
    }
}
