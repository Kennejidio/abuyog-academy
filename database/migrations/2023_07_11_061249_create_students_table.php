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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('learners_reference_number', 15);
            $table->enum('enrollment_status', ['enrolled', 'pending', 'admitted', 'not_enrolled'])->default('pending');
            $table->boolean('is_approved')->default(false);
            $table->string('firstname', 50);
            $table->string('middlename', 50);
            $table->string('lastname', 50);
            $table->string('extname', 6);
            $table->date('birthdate')->nullable();
            $table->enum('sex', ['male', 'female', 'undefined'])->default('undefined');
            $table->string('street', 40);
            $table->string('barangay', 40);
            $table->string('municipal', 40);
            $table->string('province', 40);
            $table->string('zip_code', 6);
            $table->string('mother_name', 95);
            $table->string('father_name', 95);
            $table->string('guardian_name', 95);
            $table->string('emergency_contact_number', 12);
            $table->string('last_elementary_school', 95);
            $table->string('last_grade_level_completed', 8);
            $table->string('last_school_year_completed', 10);
            $table->string('last_school_name', 95);
            $table->string('last_school_address', 95);
            $table->string('last_school_id', 15);
            $table->timestamps();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("created_by")->constrained("users");
            $table->foreignId("updated_by")->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
