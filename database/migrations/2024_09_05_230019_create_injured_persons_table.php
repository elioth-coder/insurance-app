<?php

use App\Models\Accident;
use App\Models\User;
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
        Schema::create('injured_persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('contact_number');
            $table->float('claimable_amount');
            $table->text('details');
            $table->string('supporting_files')->nullable();
            $table->string('status');
            $table->string('remarks')->nullable();
            $table->foreignIdFor(Accident::class, 'accident_id');
            $table->foreignIdFor(User::class, 'agent_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('injured_persons');
    }
};
