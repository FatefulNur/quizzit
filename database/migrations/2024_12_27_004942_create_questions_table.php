<?php

use App\Enums\QuestionType;
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
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('hint')->nullable();
            $table->string('type')->default(QuestionType::MULTIPLE_CHOICE->value);
            $table->foreignUuid('tenant_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('form_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('section_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_required')->default(false);
            $table->boolean('shuffle_options')->default(false);
            $table->unsignedSmallInteger('order_index')->default(0)->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropIndex(['order_index']);
            $table->dropForeign(['tenant_id']);
            $table->dropForeign(['form_id']);
            $table->dropForeign(['section_id']);
            $table->dropIfExists();
        });
    }
};
