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
        Schema::create('Notification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User to whom the notification belongs
            $table->unsignedBigInteger("notificationType"); // Notification type ( message, likes, matches)
            $table->string("message"); // Message of the notification
            $table->boolean("read")->default(false); // Whether the notification is read or not
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Notification');
    }
};
