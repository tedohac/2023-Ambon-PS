<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_npk', 10);
            $table->bigInteger('user_role_id')->unsigned()->index();
            $table->string('user_name', 200);
            $table->string('user_password', 200);
            $table->char('user_status', 1);
            $table->timestamps();
            $table->primary('user_npk');
            $table->foreign('user_role_id')->references('role_id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
