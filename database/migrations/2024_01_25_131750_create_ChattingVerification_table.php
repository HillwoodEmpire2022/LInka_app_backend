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
        Schema::create('ChattingVerification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscription_linka_id");
            $table->unsignedBigInteger("sender_id");
            $table->unsignedBigInteger("receiver_id");
            $table->string("amount");
            $table->string("status")->default("Paid")->comment("Paid, Unpaid, Pending, Free");
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('receiver_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('subscription_linka_id')->references('id')->on('SubscriptionLinka')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ChattingVerification');
    }
};
