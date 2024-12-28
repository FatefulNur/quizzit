<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text')->nullable();
            $table->foreignUuid('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('question_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('option_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('mark_others_incorrect')->default(false);
            $table->unsignedSmallInteger('points')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropForeign(['question_id']);
            $table->dropForeign(['option_id']);
            $table->dropIfExists();
        });
    }
};
