<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_profile_user');
            $table->string('name_education')->nullable();
            $table->string('learning_education')->nullable();
            $table->string('business_education')->nullable();
            $table->date('from_datetime_education')->nullable();
            $table->date('to_datetime_education')->nullable();
            $table->integer('deleted')->default(0);
            $table->timestamps();

            $table->foreign('id_profile_user')->references('id')->on('profile_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_user');
    }
}
