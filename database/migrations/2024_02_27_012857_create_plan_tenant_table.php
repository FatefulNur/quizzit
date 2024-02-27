<?php

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plan_tenant', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(Plan::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Tenant::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_tenant', function (Blueprint $table) {
            $table->dropForeignIdFor(Plan::class);
            $table->dropForeignIdFor(Tenant::class);
            $table->dropIfExists();
        });
    }
};
