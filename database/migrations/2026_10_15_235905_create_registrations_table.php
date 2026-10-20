<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('full_name');
            $table->string('dni', 20);
            $table->string('email');
            $table->string('phone')->nullable();

            $table->string('status')->default('registered');

            $table->string('certificate_code', 64)
                ->nullable()
                ->unique();

            $table->timestamp('certificate_issued_at')->nullable();

            $table->timestamps();

            $table->unique(['course_id', 'dni']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
