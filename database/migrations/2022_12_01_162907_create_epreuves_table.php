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
        Schema::create('epreuves', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('examen_concours')->nullable();
            $table->string('epreuve')->nullable();

            $table->string('matiere')->nullable();

            $table->text('description')->nullable();

            $table->time('duree')->nullable();
            $table->dateTime('loge')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epreuves');
    }
};
