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
        Schema::create('Matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("match_id_from");
            $table->unsignedBigInteger("match_id_to");
            $table->boolean("aproved")->default(false);
            $table->timestamps();

            $table->foreign('match_id_from')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('match_id_to')->references('id')->on('LinkaUsers')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Matches');
    }
};
