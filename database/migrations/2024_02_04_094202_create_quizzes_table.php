<?php

use App\Models\User;
use App\Models\Tenant;
use App\Enums\QuizType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('marks_total')->nullable();
            $table->string('type')->default(QuizType::PUBLIC ->value);
            $table->integer('timer')->nullable();
            $table->boolean('is_timeout')->default(0);
            $table
                ->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Tenant::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->timestamp('started_at');
            $table->timestamp('expired_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Tenant::class);
            $table->dropIfExists();
        });
    }
};
