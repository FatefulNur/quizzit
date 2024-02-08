<?php

use App\Enums\QuestionType;
use App\Models\Quiz;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('hint');
            $table->integer('marks');
            $table->string('type')->default(QuestionType::SHORT_TEXT->value);
            $table
                ->foreignIdFor(Quiz::class)
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
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeignIdFor(Quiz::class);
            $table->dropIfExists();
        });
    }
};
