<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsernameToNbCompaniesInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nb_companies_info', function (Blueprint $table) {
            //
            $table->char('username',255)->nullable()->after('image_cover');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nb_companies_info', function (Blueprint $table) {
            //
            $table->dropColumn('username');
        });
    }
}
