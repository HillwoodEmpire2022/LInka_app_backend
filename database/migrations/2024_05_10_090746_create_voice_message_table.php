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
        Schema::create('voice_message', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sender_id");
            $table->unsignedBigInteger("receiver_id");
<<<<<<< HEAD:database/migrations/2024_01_25_131750_create_ChattingVerification_table.php
            $table->string("amount");
            $table->string("status")->default("Verified")->comment("Verified, Unverified, Pending");
            $table->timestamps();
=======
            $table->string("voice_url");
            $table->string("status")->default("Active")->comment("this could be , active, inactive , deleted");
            $table->unsignedBigInteger("conversation_id")->default('1');
           

>>>>>>> Chatting_Feature:database/migrations/2024_05_10_090746_create_voice_message_table.php
            $table->foreign('sender_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('receiver_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
<<<<<<< HEAD:database/migrations/2024_01_25_131750_create_ChattingVerification_table.php
            $table->foreign('subscription_linka_id')->references('id')->on('SubscriptionLinka')
                ->onDelete('restrict')
=======
            
            $table->foreign('conversation_id')->references('id')->on('conversation')
                ->onDelete('cascade')
>>>>>>> Chatting_Feature:database/migrations/2024_05_10_090746_create_voice_message_table.php
                ->onUpdate('cascade');

            $table->timestamp('reat_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voice_message');
    }
};
