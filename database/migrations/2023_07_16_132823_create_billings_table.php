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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_year_id')->constrained('school_years');
            $table->foreignId("student_id")->constrained("students");
            $table->string("code");
            $table->string("description")->nullable();
            $table->integer('amount')->nullable();
            $table->integer('amount_paid')->nullable();
            $table->enum('billing_status', ['paid', 'partially_paid', 'unpaid'])->default('unpaid');
            $table->date('payment_date')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
