<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kips', function (Blueprint $table) {
            $table->string('kip_no', 30);
            $table->date('kip_penemuan_date');
            $table->mediumText('kip_permasalahan');
            $table->mediumText('kip_keadaan_seharusnya');
            $table->mediumText('kip_aktivitas_perbaikan');
            $table->bigInteger('kip_pemborosan_biaya')->nullable();
            $table->string('kip_created_by');
            $table->datetime('kip_created_on');
            $table->datetime('kip_submit_date')->nullable();
            $table->string('foto_before')->nullable();
            $table->string('foto_after')->nullable();
            $table->integer('biaya_perbaikan')->nullable();
            $table->integer('perhitungan_benefit')->nullable();
            $table->string('lampiran_benefit')->nullable();
            $table->tinyInteger('status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kips');
    }
}
