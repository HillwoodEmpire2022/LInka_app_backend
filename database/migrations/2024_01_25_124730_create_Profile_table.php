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
        Schema::create('Profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("linka_user_id");
            $table->string("firstName");
            $table->string("lastName");
            $table->string("nickName")->comment("This nick name will take name of username from users");
            $table->string("age");
            $table->string("gender");
            $table->string("country");
            $table->string("height");
            $table->string("weight");
            $table->text("personalInfo");
            $table->string("sexualOrientation")->comment("this could be Straight, Gay, Lesbian, bisexual, asexual, demi sexual");
            $table->string("lookingFor")->default("Relationship")->comment("Here could be serious or just friendship");
            $table->text("lookingDescription");
            $table->string("profileImagePath");
            $table->timestamps();

            $table->foreign('linka_user_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Profile');
    }
};
