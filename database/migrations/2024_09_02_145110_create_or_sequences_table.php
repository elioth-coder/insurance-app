<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('or_sequences', function (Blueprint $table) {
            $table->id();
            $table->string('branch_code')->unique();
            $table->integer('last_sequence')->default(0);
            $table->date('last_reset_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('or_sequences');
    }
};
