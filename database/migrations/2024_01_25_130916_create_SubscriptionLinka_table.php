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
        Schema::create('SubscriptionLinka', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("subscription_type_id"); // this id could be subscription type id of linka only
            $table->string("packageName"); // free package, one to one chatting, monthly subscription, premium
            $table->string("amount")->default("0");
            $table->string("description")->comment("This will be description of the package subscription");
            $table->string("status")->default("Active");
            $table->timestamps();

            $table->foreign('subscription_type_id')->references('id')->on('SubscriptionType')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SubscriptionLinka');
    }
};
