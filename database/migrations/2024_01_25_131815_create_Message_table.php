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
        Schema::create('Message', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('conversation_id')->constrained();
            $table->unsignedBigInteger("sender_id");
            $table->unsignedBigInteger("receiver_id");
            $table->text("content");
            $table->string("status")->default("Active")->comment("this could be , active, inactive , deleted");
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('receiver_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->timestamp('reat_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Message');
    }
};
