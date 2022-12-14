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

            $table->boolean('dictionnaire');
            $table->boolean('calculatrice');
            $table->boolean('estdematerialise');

            $table->text('commentaire')->nullable();
            $table->text('regle')->nullable();

            $table->dateTime('date');

            $table->unsignedBigInteger('formation_id');
            $table->foreign('formation_id')->references('id')->on('formations');

            $table->unsignedBigInteger('epreuve_id');
            $table->foreign('epreuve_id')->references('id')->on('epreuves');

            $table->unsignedBigInteger('salle_id');
            $table->foreign('salle_id')->references('id')->on('salles');


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
