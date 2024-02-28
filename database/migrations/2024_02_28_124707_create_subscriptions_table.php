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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('identity');
            $table->string('plan_name');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('status');
            $table->string('card_brand');
            $table->timestamp('renews_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table
                ->foreignIdFor(Plan::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Tenant::class)
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
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeignIdFor(Plan::class);
            $table->dropForeignIdFor(Tenant::class);
            $table->dropIfExists();
        });
    }
};
