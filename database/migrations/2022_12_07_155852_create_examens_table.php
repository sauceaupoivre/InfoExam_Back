<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('repere')->nullable();

            $table->text('description')->nullable();
            $table->boolean('dictionnaire');
            $table->boolean('calculatrice');
            $table->text('commentaire')->nullable();

            $table->dateTime('date');
            $table->dateTime('debutepreuve');
            $table->dateTime('finepreuve');
            $table->dateTime('tierstemps');
            $table->dateTime('sortie');

            $table->unsignedBigInteger('formation_id');
            $table->foreign('formation_id')->references('id')->on('formations');

            $table->unsignedBigInteger('epreuve_id');
            $table->foreign('epreuve_id')->references('id')->on('epreuves');

            $table->unsignedBigInteger('salle_id');
            $table->foreign('salle_id')->references('id')->on('salles');

            $table->unsignedBigInteger('cartouche_id');
            $table->foreign('cartouche_id')->references('id')->on('cartouches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examens');
    }
};
