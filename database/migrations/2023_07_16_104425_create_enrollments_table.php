<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_year_id')->constrained('school_years');
            $table->foreignId("student_id")->constrained("students");
            $table->foreignId('section_id')->constrained('sections');
            $table->date('enroll_date')->default(DB::raw('NOW()'));
            $table->enum('enrollment_status', ['enrolled', 'pending', 'admitted', 'not_enrolled'])->default('pending');
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
        Schema::dropIfExists('enrollments');
    }
};
