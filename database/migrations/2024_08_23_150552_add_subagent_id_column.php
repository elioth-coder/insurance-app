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
        Schema::table('coc_series_numbers', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'subagent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coc_series_numbers', function (Blueprint $table) {
            $table->dropColumn('subagent_id');
        });
    }
};
