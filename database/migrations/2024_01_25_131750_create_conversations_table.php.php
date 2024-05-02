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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')
            ->references('id')
            ->on('LinkaUsers') 
            ->name('conversations_sender_id_foreign')
            ->onDelete('cascade')
            ->onUpdate('cascade');;

            $table->unsignedBigInteger('receiver_id');
            $table->foreign('sender_id')
            ->references('id')
            ->on('LinkaUsers')
            ->name('conversations_receiver_id_foreign')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
