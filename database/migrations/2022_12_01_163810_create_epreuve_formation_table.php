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
        Schema::create('epreuve_formation', function (Blueprint $table) {
            $table->timestamps();

            $table->unsignedBigInteger('epreuve_id');
            $table->foreign('epreuve_id')->references('id')->on('epreuves');
            $table->unsignedBigInteger('formation_id');
            $table->foreign('formation_id')->references('id')->on('formations');

            $table->primary(['epreuve_id','formation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epreuve_formation');
    }
};
