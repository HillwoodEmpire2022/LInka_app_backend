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
        Schema::create('ProfileMemberInterest', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("linka_user_id");
            $table->string("interestName");
            $table->string("status")->default("Active");
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
        Schema::dropIfExists('ProfileMemberInterest');
    }
};
