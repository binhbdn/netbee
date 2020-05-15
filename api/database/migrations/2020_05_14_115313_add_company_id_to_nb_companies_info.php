<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdToNbCompaniesInfo extends Migration
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
            $table->integer('nation_id')->after('created_at')->nullable();
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
            $table->dropColumn('nation_id');
        });
    }
}
