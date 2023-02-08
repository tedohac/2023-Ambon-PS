<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->string('permission_user_npk', 10);
            $table->string('permission_role_code', 30);
            $table->primary(array('permission_user_npk', 'permission_role_code'));
            $table->foreign('permission_user_npk')->references('user_npk')->on('users');
            $table->foreign('permission_role_code')->references('role_code')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
