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
            $table->unsignedBigInteger('LinkerUserID');
            $table->dateTime('Appointment_date');
            $table->unsignedBigInteger('TherapyType');
            $table->unsignedBigInteger('Therapist_Assigned');
            $table->string('Appointment_Status')->comment('This can be DONE, TO DO or FAILED')->default('TO DO');
            $table->timestamps();


            $table->foreign('LinkerUserID')->references('user_id')->on('LinkaUsers')
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