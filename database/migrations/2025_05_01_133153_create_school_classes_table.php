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
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class_name');
            $table->string('subject');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->integer('student_count')->default(0);
            $table->string('section')->nullable();
            $table->text('description')->nullable();
            $table->string('class_code')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};
