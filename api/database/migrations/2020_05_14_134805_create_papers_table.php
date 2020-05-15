<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nb_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('front_id_card')->nullable()->comment('mặt trc cmnd');
            $table->text('back_id_card')->nullable()->comment('mặt sau cmnd');
            $table->text('health_certification')->nullable()->comment('giấy khám sức khỏe');
            $table->text('high_school_diploma')->nullable()->comment('bằng tốt nghiệp');
            $table->text('passport')->nullable()->comment('hộ chiếu');
            $table->text('birth_certificate')->nullable()->comment('giấy khai sinh');
            $table->text('curriculum_vitae')->nullable()->comment('sơ yếu lý lịch');
            $table->text('portrait_3x4')->nullable()->comment('ảnh chân dung 3x4');
            $table->text('portrait_4x6')->nullable()->comment('ảnh 4x6');
            $table->integer('apply_id', 4);
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
        Schema::dropIfExists('papers');
    }
}
