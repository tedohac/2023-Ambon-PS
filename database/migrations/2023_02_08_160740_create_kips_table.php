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
            $table->string('kip_no', 20);
            $table->string('kip_judul_tema', 300);
            $table->string('kip_created_by', 10);
            $table->datetime('kip_created_on');
            $table->datetime('kip_submit_date')->nullable();
            $table->string('kip_kategori', 100)->nullable();
            $table->string('kip_line', 50)->nullable();
            $table->string('kip_proses', 50)->nullable();
            $table->text('kip_masalah')->nullable();
            $table->text('kip_perbaikan')->nullable();
            $table->string('kip_foto_sebelum', 50)->nullable();
            $table->string('kip_foto_sesudah', 50)->nullable();
            $table->text('kip_eval_uraian')->nullable();
            $table->text('kip_eval_biaya')->nullable();
            $table->text('kip_eval_benefit_kuantitatif')->nullable();
            $table->text('kip_eval_benefit_kualitatif')->nullable();
            $table->text('kip_pengontrolan')->nullable();
            $table->text('kip_saran')->nullable();
            $table->primary('kip_no');
            $table->foreign('kip_user_npk')->references('user_npk')->on('users');
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
