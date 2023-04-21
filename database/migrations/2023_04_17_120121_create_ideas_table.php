<?php

declare(strict_types=1);

use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('ideas', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->text('description');
            $table->string('status')->default(Status::SUBMITTED->value);
            $table->string('category');

            $table->unsignedBigInteger('votes')->default(0);

            $table
                ->foreignUlid('user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ideas');
    }
};
