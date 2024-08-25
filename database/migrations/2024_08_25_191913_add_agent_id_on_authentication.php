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
        Schema::table('authentications', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'agent_id');
            $table->float('upload_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('authentications', function (Blueprint $table) {
            $table->dropColumn('agent_id');
            $table->dropColumn('upload_rate');
        });
    }
};
