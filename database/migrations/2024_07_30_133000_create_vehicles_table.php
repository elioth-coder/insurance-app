<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Client;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class);
            $table->string('plate_number');
            $table->string('mv_file_number');
            $table->string('make');
            $table->string('model');
            $table->string('color');
            $table->string('body_type');
            $table->string('chassis_number');
            $table->string('engine_number');
            $table->string('load_capacity');
            $table->string('unladen_weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
