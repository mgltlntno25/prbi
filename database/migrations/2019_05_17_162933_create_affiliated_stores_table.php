<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffiliatedStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliated_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store_name');
            $table->string('store_owner');
            $table->string('address');
            $table->string('email');
            $table->string('contact');
            $table->string('password')->default('prbi123');
            $table->string('image')->default('avatar.png');
            $table->string('role')->default('affiliatedstore');
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
        Schema::dropIfExists('affiliated_stores');
    }
}
