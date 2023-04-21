<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('votes', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table
                ->foreignUlid('idea_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table
                ->foreignUlid('user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();

            $table->unique(['idea_id', 'user_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
