<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Category;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Idea extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'description',
        'status',
        'category',
        'votes',
        'user_id',
    ];

    protected $casts = [
        'status' => Status::class,
        'category' => Category::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    public function votes(): HasMany
    {
        return $this->hasMany(
            related: Vote::class,
            foreignKey: 'idea_id',
        );
    }
}
