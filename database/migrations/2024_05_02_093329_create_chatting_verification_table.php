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
        Schema::create('chatting_verification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscription_linka_id");
            $table->unsignedBigInteger("linkerUser_id");
            $table->string("status")->default("Verified")->comment("Verified, Unverified, Pending");
            $table->string("amount");
            $table->timestamps();

            $table->foreign('linkerUser_id')->references('user_id')->on('LinkaUsers')
                             ->onDelete('cascade')
                             ->onUpdate('cascade');
            
            $table->foreign('subscription_linka_id')->references('id')->on('SubscriptionLinka')
                             ->onDelete('restrict')
                             ->onUpdate('cascade');
            
            $table->engine = 'InnoDB';

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatting_verification');
    }
};
