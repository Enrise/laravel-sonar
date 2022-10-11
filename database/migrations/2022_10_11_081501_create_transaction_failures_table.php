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
        Schema::create('transaction_failures', function (Blueprint $table): void {
            $table->ulid();
            $table->timestamps();
            $table->foreignUlid('transaction_id');
            $table->string('error_message');
            $table->boolean('is_resolved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_failures');
    }
};
