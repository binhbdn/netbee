<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNbBankHrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nb_bank_hr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('name', 191)->nullable();
            $table->string('stk', 50)->nullable();
            $table->string('branch', 191)->nullable();
            $table->string('bankName', 50)->nullable();
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
        Schema::dropIfExists('nb_bank_hr');
    }
}
