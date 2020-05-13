<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToNbCompaniesInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nb_companies_info', function (Blueprint $table) {
            $table->text('image_cover')->after('company_verify')->nullable();
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
            $table->dropColumn('image_cover');
        });
    }
}
