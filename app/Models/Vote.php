<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Vote extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'idea_id',
        'user_id',
    ];

    public function idea(): BelongsTo
    {
        return $this->belongsTo(
            related: Idea::class,
            foreignKey: 'idea_id',
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }
}
