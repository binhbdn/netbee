<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNbHistoryCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nb_history_call', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');            
            $table->string('id_room', 40);
            $table->integer('action')->default(0)->comment('0:Tạo, 1:Vào, 2:Rời');            
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
        Schema::dropIfExists('nb_history_call');
    }
}
