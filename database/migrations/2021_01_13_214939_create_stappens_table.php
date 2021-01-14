<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStappensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stappen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brief_id')->constrained('switchbriefs');
            $table->string('plaats');
            $table->string('veld');
            $table->string('turbine');
            $table->string('omschrijving');
            $table->string('voltooid');
            $table->string('datum');
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
        Schema::dropIfExists('stappen');
    }
}
