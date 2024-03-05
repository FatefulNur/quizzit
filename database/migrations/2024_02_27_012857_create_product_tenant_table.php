<?php

use App\Models\Product;
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
        Schema::create('product_tenant', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(Product::class)
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
        Schema::table('product_tenant', function (Blueprint $table) {
            $table->dropForeignIdFor(Product::class);
            $table->dropForeignIdFor(Tenant::class);
            $table->dropIfExists();
        });
    }
};
