<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvatarFeedToCompanyFeedback extends Migration
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
            $table->string('avatar_feed')->after('approve_feed')->nullable();
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
            $table->dropColumn('avatar_feed');
        });
    }
}
