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
        Schema::create('SubscriptionLinkaMembersType', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("linka_user_id");
            $table->unsignedBigInteger("subscription_type_linka_id");
            $table->string("packageName");
            $table->string("amount");
            $table->string("startDate")->nullable();
            $table->string("endDate")->nullable();
            $table->string("status")->default("Inactive")->comment("Active, Inactive, Suspended");
            $table->timestamps();

            $table->foreign('subscription_type_linka_id')->references('id')->on('SubscriptionLinka')
                ->onDelete('restrict')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('SubscriptionLinkaMembersType');
    }
};
