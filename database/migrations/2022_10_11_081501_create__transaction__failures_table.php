<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_failures', function (Blueprint $table) {
            $table->ulid();
            $table->timestamps();
            $table->foreignUlid('transaction_id')->constrained('transactions');
            $table->string('error_message');
            $table->boolean('is_resolved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_failures');
    }
};
