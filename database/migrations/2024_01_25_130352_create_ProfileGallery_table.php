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
        Schema::create('ProfileGallery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("linka_user_id");
            $table->string("pathImage")->comment("this will be gallery images of the users");
            $table->boolean("isProfile")->default(false);
            $table->string("status")->default("Active")->comment("This status will be active or inactive, only privacy to you, public");
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
        Schema::dropIfExists('ProfileGallery');
    }
};
