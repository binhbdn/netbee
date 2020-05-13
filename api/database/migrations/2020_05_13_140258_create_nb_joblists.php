<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNbJoblists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nb_joblists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->integer('nation_id');
            $table->integer('id_created');
            $table->boolean('status');
            $table->text('title')->nullable();
            $table->text('description');
            $table->integer('id_visa')->nullable();
            $table->text('request')->nullable();
            $table->text('benefit')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('work_form')->nullable();
            $table->integer('age_start')->nullable();
            $table->integer('age_late')->nullable();
            $table->string('salary_start', 31)->nullable();
            $table->string('salary_end', 31)->nullable();
            $table->integer('subsidy')->nullable();
            $table->string('currency', 7)->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_test')->nullable();
            $table->date('expiration_date')->nullable();
            $table->date('expected_date')->nullable();
            $table->text('workplace')->nullable();
            $table->text('cv_content')->nullable();
            $table->integer('bonus')->nullable();
            $table->integer('time_bonus')->nullable();
            $table->boolean('highlight_job');
            $table->string('school_name', 127)->nullable();
            $table->boolean('deleted');
            $table->boolean('is_public');
            $table->boolean('is_draft');
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
        Schema::dropIfExists('nb_joblists');
    }
}
