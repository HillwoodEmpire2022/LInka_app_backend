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
        Schema::create('appointment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('Full_name');
            $table->string('Age');
            $table->string('Location')->default('Kigali city');
            $table->string('Gender')->comment('Male or Female');
            $table->text('Message')->default('I want a Therapist');
            $table->string('Phone_number');
            $table->unsignedBigInteger('TherapyType_needed')->comment('This is the kind of Therapy a patient need');
            $table->timestamps();

            $table->foreign('TherapyType_needed')->references('id')->on('therapy_types')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_requests');
    }
};
