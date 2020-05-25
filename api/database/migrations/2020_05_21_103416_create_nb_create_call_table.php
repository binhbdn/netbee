<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNbCreateCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nb_create_call', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_applies');
            $table->string('id_room', 40);
            $table->integer('idjob');
            $table->timestamps();    
            
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_applies')->references('id')->on('nb_applies');
            $table->foreign('idjob')->references('id')->on('nb_joblists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nb_create_call');
    }
}
