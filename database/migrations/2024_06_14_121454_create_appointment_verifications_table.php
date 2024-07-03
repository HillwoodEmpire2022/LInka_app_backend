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
        Schema::create('appointment_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('Full_name');
            $table->dateTime('Appointment_date');
            $table->unsignedBigInteger('TherapyType');
            $table->unsignedBigInteger('Therapist_Assigned');
            $table->string('consultation_type')->default('video')->comment('this can be video, face-to-face, phone call');;
            $table->string('Appointment_Status')->comment('This can be PENDING, FINISHED or FAILED')->default('TO DO');
            $table->timestamps();


            $table->foreign('Full_name')->references('Full_name')->on('appointment_requests')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');  

            $table->foreign('Therapist_Assigned')->references('id')->on('therapists')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            
            $table->foreign('TherapyType')->references('id')->on('therapy_types')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_verifications');
    }
};