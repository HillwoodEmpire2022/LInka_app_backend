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
        Schema::create('LinkaUsers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->unique();
            $table->unsignedBigInteger("user_type_id");
            $table->string("provider")->nullable(); // google, facebook, twitter, app,...
            $table->string('provider_id')->nullable(); // this to store provider's ID
            $table->string("status")->default("Active");
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')
            //     ->onDelete('restrict')
            //     ->onUpdate('cascade');

            // $table->foreign('user_type_id')->references('id')->on('UsersType')
            //     ->onDelete('restrict')
            //     ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LinkaUsers');
    }
};
