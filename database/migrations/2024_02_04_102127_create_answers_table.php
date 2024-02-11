<?php

use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use App\Models\UserResponse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('correct');
            $table
                ->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(UserResponse::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Question::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Option::class)
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
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(UserResponse::class);
            $table->dropForeignIdFor(Question::class);
            $table->dropForeignIdFor(Option::class);
            $table->dropIfExists();
        });
    }
};
