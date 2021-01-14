<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SwitchbriefTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('switchbrief_step', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('brief_id')->constrained('switchbriefs');
            $table->integer('step');
            $table->string('place');
            $table->string('field');
            $table->string('turbine');
            $table->integer('description');
            $table->boolean('voltooid');
            $table->date('date_completion');
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
        Schema::dropIfExists('switchbrief_step');
    }
}