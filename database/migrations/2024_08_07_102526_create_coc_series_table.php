<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coc_series', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'agent_id');
            $table->string('prefix')->nullable();
            $table->string('suffix')->nullable();
            $table->integer('start');
            $table->integer('end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coc_series');
    }
};
