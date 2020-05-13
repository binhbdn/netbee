<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIntToFloatInNbCompanyFeedbacks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nb_company_feedbacks', function (Blueprint $table) {
            //
            $table->float('rate_feed',2,1)->default(4.5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nb_company_feedbacks', function (Blueprint $table) {
            //
            $table->dropColumn('rate_feed');
        });
    }
}
