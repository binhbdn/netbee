<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 63)->nullable();
            $table->string('email', 127);
            $table->integer('role');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password', 127);
            $table->boolean('status');
            $table->string('remember_token', 127)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('birth_of_date', 15)->nullable();
            $table->string('address_detail')->nullable();
            $table->text('avatar')->nullable();
            $table->boolean('block');
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
        Schema::dropIfExists('users');
    }
}
