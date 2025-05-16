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
        Schema::create('marks', function (Blueprint $table) {
            $table->id(); // auto-incrementing unsigned bigint column for primary key
            $table->unsignedBigInteger('student_id'); // foreign key column
            $table->unsignedBigInteger('class_id'); // foreign key column
            $table->string('subject');
            $table->decimal('marks_obtained', 5, 2);
            $table->decimal('max_marks', 5, 2);
            $table->string('exam_type');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
