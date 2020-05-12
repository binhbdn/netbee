<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_user')->unsigned();
            $table->string('fullname_profile')->nullable();
            $table->date('birthday_profile')->nullable();
            $table->string('maleFemale')->nullable();
            $table->string('address_profile')->nullable();
            $table->string('phone_profile')->nullable();
            $table->string('email_profile')->nullable();            
            $table->string('note_profile')->nullable();
            $table->string('title_target_profile')->nullable();
            $table->string('note_target_profile')->nullable();
            $table->string('skill_communication_profile')->nullable();
            $table->string('skill_information_profile')->nullable();
            $table->string('skill_logic_profile')->nullable();
            $table->string('certificate_profile')->nullable();
            $table->string('level_education')->nullable();
            $table->string('name_education')->nullable();
            $table->string('specialized_education')->nullable();
            $table->integer('deleted')->default(0);            
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_user');
    }
}
