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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('institution');
            $table->string('country');
            $table->string('email')->unique();
            $table->string('phone');
            $table->enum('category', ['presenter', 'non_presenter']);
            $table->enum('attendance', ['onsite', 'online']);
            $table->enum('participant_origin', ['ina', 'intl']);
            $table->string('paper_title')->nullable();
            $table->decimal('fee_amount', 12, 2);
            $table->string('fee_currency', 3);
            $table->string('payment_proof');
            $table->enum('payment_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->boolean('certificate_eligible')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
