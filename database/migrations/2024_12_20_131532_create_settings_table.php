<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('confirmation_message')->nullable();
            $table->foreignUuid('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('form_id')->constrained()->cascadeOnDelete();
            $table->boolean('allow_submissions')->default(true);
            $table->boolean('enable_autosave_responses')->default(true);
            $table->boolean('shuffle_questions')->default(false);
            $table->boolean('enable_single_submission')->default(false);
            $table->boolean('allow_submission_edits')->default(false);
            $table->boolean('is_quiz')->default(false);
            $table->json('quiz_settings')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
            $table->dropForeign(['form_id']);
            $table->dropIfExists();
        });
    }
};
