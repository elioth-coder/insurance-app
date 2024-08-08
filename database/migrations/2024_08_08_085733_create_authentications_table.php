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
        Schema::create('authentications', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('plate_number')->nullable();
            $table->string('mv_file_number')->nullable();
            $table->string('serial_number');
            $table->string('engine_number')->nullable();
            $table->string('assured_tin')->nullable();
            $table->string('assured_name');
            $table->string('assured_address');
            $table->string('contact_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('or_number');
            $table->string('coc_number');
            $table->string('policy_number');
            $table->date('inception_date');
            $table->date('expiry_date');
            $table->string('vehicle_type');
            $table->string('lto_mv_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authentications');
    }
};
