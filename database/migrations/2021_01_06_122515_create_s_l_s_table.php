<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSLSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switchbriefs', function (Blueprint $table) {
            $table->id();
            $table->integer('briefnr');
            $table->string('windpark');
            $table->string('date');
            $table->string('ivname');
            $table->string('ivtel');
            $table->string('mvname');
            $table->string('mvtel');
            $table->string('plname');
            $table->string('pltel');
            $table->string('bedrijf');
            $table->string('bedrijftel');
            $table->string('contact');
            $table->string('contacttel');
            $table->mediumText('remarks');
            $table->mediumText('plremarks');
            $table->mediumText('reason');
            $table->string('ivakkoord');
            $table->string('mvakkoord');
            $table->string('plakkoord');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('switchbriefs');
    }
}
