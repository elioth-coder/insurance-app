<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Vehicle;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Vehicle::class);
            $table->string('or_number');
            $table->string('coc_number');
            $table->string('policy_number');
            $table->date('issue_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('premiums_paid');
            $table->double('amount_due');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
