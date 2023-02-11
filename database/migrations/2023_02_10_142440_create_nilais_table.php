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
        Schema::create('nilais', function (Blueprint $table) {
            $table->string('nilai_kip_no', 20);
            $table->string('nilai_created_by', 10);
            $table->string('nilai_level', 30);
            $table->integer('nilai_penghematan');
            $table->integer('nilai_quality');
            $table->integer('nilai_safety');
            $table->integer('nilai_ergonomi');
            $table->integer('nilai_manfaat');
            $table->integer('nilai_kepekaan');
            $table->integer('nilai_keaslian');
            $table->integer('nilai_usaha');
            $table->primary(array('nilai_kip_no', 'nilai_created_by', 'nilai_level'));
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
