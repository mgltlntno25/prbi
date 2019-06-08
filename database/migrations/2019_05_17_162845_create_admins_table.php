<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('contact');
            $table->string('password')->default('$2y$10$Sg9rrRZ5fWLo.5z1Ua.a4OTDMYBkOSp4ZcWuyYwzuU9Ho22CYNShy');
            $table->string('profile_image')->default('avatar.png');
            $table->string('address')->default('');
            $table->string('gender')->default('');
            $table->string('birthday')->default('');
            $table->string('age')->default('');
            $table->string('role')->default('admin');
            $table->string('status')->default('inactive');
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
        Schema::dropIfExists('admins');
    }
}
