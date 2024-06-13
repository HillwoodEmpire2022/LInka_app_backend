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
        Schema::create('tips', function (Blueprint $table) {
            $table->id();

            $table->string('tip_title');
            $table->string('tip_type')->nullable()->comment('This can be Family tip, friendship tip, dating or etc');
            $table->string('image')->nullable();
            $table->string('video_tip')->nullable()->comment('if we have tips recorded as video must be stored here');
            $table->string('audio_tip')->nullable()->comment('if we have tip recorded as audio must be stored here');
            $table->longText('description');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tips');
    }
};

