<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('prbi_id');
            $table->string('profile_image')->default('avatar.png');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('contact');
            $table->string('address');
            $table->string('password');
            $table->string('emergency_name');
            $table->string('emergency_contact');
            $table->string('birthday');
            $table->string('gender');
            $table->string('isEmailVerified')->default('0');
            
            //update
            $table->string('blood_type')->nullable();
            $table->string('valid_id')->nullable();
            $table->string('qrcode');
            $table->boolean('isVerified_email')->default(0);
            $table->boolean('isVerified_contact')->default(0);
            $table->boolean('isPremium')->default(0);
            $table->boolean('isInsured')->default(0);
            $table->string('status')->default('inactive');
            $table->string('role')->default('user');
            $table->string('key')->nullable();
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
        Schema::dropIfExists('users');
    }
}
