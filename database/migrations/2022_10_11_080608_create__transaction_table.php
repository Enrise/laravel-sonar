<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table): void {
            $table->ulid();
            $table->enum('type', ['notification', 'schedule', 'command']);
            $table->string('class');
            $table->json('context')->nullable();
            $table->timestamp('started');
            $table->timestamp('finished')->nullable();
            $table->boolean('is_failed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
