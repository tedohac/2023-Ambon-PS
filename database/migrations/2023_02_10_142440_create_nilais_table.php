<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kips', function (Blueprint $table) {
            $table->string('nilai_kip_no', 20);
            $table->string('nilai_created_by', 10);
            $table->int('nilai_penghematan');
            $table->int('nilai_quality');
            $table->int('nilai_safety');
            $table->int('nilai_ergonomi');
            $table->int('nilai_manfaat');
            $table->int('nilai_kepekaan');
            $table->int('nilai_keaslian');
            $table->int('nilai_usaha');
            $table->int('nilai_total');
            $table->primary(array('nilai_kip_no', 'nilai_created_by'));
            $table->foreign('nilai_kip_no')->references('kip_no')->on('kips');
            $table->foreign('nilai_created_by')->references('user_npk')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}
