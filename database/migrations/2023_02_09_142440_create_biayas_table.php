<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiayasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biayas', function (Blueprint $table) {
            $table->bigIncrements('biaya_id');
            $table->string('biaya_kip_no', 20);
            $table->string('biaya_desc', 300);
            $table->int('biaya_harga');
            $table->foreign('biaya_kip_no')->references('kip_no')->on('kips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biayas');
    }
}
