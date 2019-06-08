<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profile_image')->default('avatar.png');
            $table->string('email')->default('sysadmin@prbi.com');
            $table->string('password')->default('123pbi1!');
            $table->string('role')->default('sysad');
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
        Schema::dropIfExists('sys_admins');
    }
}
