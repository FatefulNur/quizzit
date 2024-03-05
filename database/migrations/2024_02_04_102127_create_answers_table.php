<?php

use App\Models\User;
use App\Models\Option;
use App\Models\Tenant;
use App\Models\Question;
use App\Models\UserResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('correct');
            $table->string('answer');
            $table
                ->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Tenant::class)
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(UserResponse::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Question::class)
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Option::class)
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
            $table->dropForeignIdFor(Tenant::class);
            $table->dropForeignIdFor(UserResponse::class);
            $table->dropForeignIdFor(Question::class);
            $table->dropForeignIdFor(Option::class);
            $table->dropIfExists();
        });
    }
};
