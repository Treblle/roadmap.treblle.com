<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Role;
use Carbon\CarbonInterface;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property-read string $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $password
 * @property-read Role $role
 * @property-read string $remember_token
 * @property-read CarbonInterface $email_verified_at
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasUlids;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => Role::class,
        'email_verified_at' => 'datetime',
    ];

    public function ideas(): HasMany
    {
        return $this->hasMany(
            related: Idea::class,
            foreignKey: 'user_id',
        );
    }

    public function votes(): HasMany
    {
        return $this->hasMany(
            related: Vote::class,
            foreignKey: 'user_id',
        );
    }

    public function avatar(): Attribute
    {
        $name = trim(
            string: collect(explode(' ', $this->name))
                ->map(fn ($segment) => mb_substr($segment, 0, 1))
                ->join(' ')
        );

        return new Attribute(
            get: fn (): string => 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF',
        );
    }

    public function createNewToken(string $name, array $abilities = ['*'], null|string $token = null, DateTimeInterface $expiresAt = null): void
    {
        $this->tokens()->create([
            'name' => $name,
            'token' => $token,
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);
    }
}
