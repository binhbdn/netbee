<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToNbApplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nb_applies', function (Blueprint $table) {
            $table->date('birth_day', 127)->after('name');
            $table->string('phone', 127)->after('name');
            $table->string('email', 127)->after('name');
            $table->string('address', 127)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nb_applies', function (Blueprint $table) {
            $table->dropColumn('cv_file');
        });
    }
}
