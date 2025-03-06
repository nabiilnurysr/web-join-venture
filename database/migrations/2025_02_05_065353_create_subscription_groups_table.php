<?php

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
        Schema::create('subscription_groups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('max_capacity');
            $table->unsignedBigInteger('participant_count');

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_subscription_id')->constrained()->cascadeOnDelete();

            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('updated_by')->constrained('users')->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_groups');
    }
};
